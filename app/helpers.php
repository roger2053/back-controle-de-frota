<?php

function base64url_encode($data)
{
    // First of all you should encode $data to Base64 string
    $b64 = base64_encode($data);

    // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
    if ($b64 === false) {
        return false;
    }

    // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
    $url = strtr($b64, '+/', '-_');

    // Remove padding character from the end of line and return the Base64URL result
    return rtrim($url, '=');
}

function MakeJwt($request)
{
    // $request = $request->all();
    $header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];
    $header = json_encode($header);
    $header = base64_encode($header);

    $payload = $request;
    $payload = json_encode($payload);
    $payload = base64_encode($payload);

    $signature = hash_hmac('sha256', "$header.$payload", 's4mul1f3', true);
    $signature = base64url_encode($signature);

    $jwt_token = "$header.$payload.$signature";

    return $jwt_token;
}

function except($request)
{
    if (!empty($request->query()['except']) && $request->query()['except'] == 'true') {
    }
}

function get_user_data($request)
{
    $token_decoded = json_decode($request->header('Authorization'));
    return $token_decoded;
}

function jwt_decode($token)
{
    $tokenParts = explode(".", $token);
    $tokenHeader = base64_decode($tokenParts[0]);
    $tokenPayload = base64_decode($tokenParts[1]);
    $jwtHeader = json_decode($tokenHeader);
    $jwtPayload = json_decode($tokenPayload);
    return $jwtPayload->data;
}

function jwt_decode_all($token)
{
    $tokenParts = explode(".", $token);
    $tokenHeader = base64_decode($tokenParts[0]);
    $tokenPayload = base64_decode($tokenParts[1]);
    $jwtHeader = json_decode($tokenHeader);
    $jwtPayload = json_decode($tokenPayload);
    return $jwtPayload;
}



function statistic_tratament_01($data_status, $sheets, $veichles)
{
    // Sempre que for alterada a quantidade de cidades, somar mais um na quantidade de bases
    $quantity_bases = 11;
    $data_status = $data_status[0];

    $data_status["Total de Atendimentos"] = $data_status["Total de Chamadas"] - $data_status["Trote"] - $data_status["Chamadas Interrompidas"];

    $report = array();

    $report = array_merge($report, $data_status->toArray());

    $report['MT Total'] = 0;
    $report['USB Total'] = 0;
    $report['USA Total'] = 0;

    $report['Apoio MT'] = 0;
    $report['Apoio USB'] = 0;
    $report['Apoio USA'] = 0;

    $report['bases'] = array();

    for ($i = 1; $i <= $quantity_bases; $i++) {
        $report['bases'][$i] = [
            'transfer' => [],
            'attendance' => [],
            'transport' => []
        ];
    }

    foreach ($veichles as $veichle) {
        $name = $veichle["transport"];
        if ($name == "USB 01 - RT") {
            $name = "USB-RT-01";
        } else {
            $name = str_replace(" ", "-", $name);
        }

        for ($i = 1; $i <= $quantity_bases; $i++) {
            $report['bases'][$i]["transfer"][$name] = 0;
            $report['bases'][$i]["attendance"][$name] = 0;
            $report['bases'][$i]["transport"][$name] = 0;
        }

        $report["Attendance $name"] = 0;
        $report["Transfer $name"] = 0;
        $report["Transport $name"] = 0;
    }

    foreach ($sheets as $sheet) {

        if ($sheet["transport"]) {

            if (str_contains($sheet["transport"]["transport"], 'MOTO')) $report['MT Total'] += 1;
            if (str_contains($sheet["transport"]["transport"], 'USA')) $report['USA Total'] += 1;
            if (str_contains($sheet["transport"]["transport"], 'USB')) $report['USB Total'] += 1;

            if ($sheet['status_id'] != 7  && $sheet['status_id'] != 5 && $sheet['status_id'] != 4) {

                // Atendimento

                if ($sheet['transfer_code'] == null) {
                    $transport = $sheet['transport']['transport'];
                    if ($transport == "USB 01 - RT") {
                        $transport = "USB-RT-01";
                    } else {
                        $transport = str_replace(" ", "-", $transport);
                    }

                    $report["Attendance $transport"] += 1;
                    if ($sheet['patient_city']) {
                            $report['bases'][$sheet['patient_city']]['attendance'][$transport] += 1;
                    }
                }


                // Transferência

                if ($sheet['transfer_code']) {

                    $transport = $sheet['transport']['transport'];
                    if ($transport == "USB 01 - RT") {
                        $transport = "USB-RT-01";
                    } else {
                        $transport = str_replace(" ", "-", $transport);
                    }

                    $report["Transfer $transport"] += 1;
                    if ($sheet['patient_city']) {
                        $report['bases'][$sheet['patient_city']]['transfer'][$transport] += 1;
                    }
                }

                // Transporte

                if ($sheet['transfer_inner_transport'] == 1) {

                    if ($sheet['transfer_origin'] && $sheet['transfer_destiny']) {
                        $transport = $sheet['transport']['transport'];
                        if ($transport == "USB 01 - RT") {
                            $transport = "USB-RT-01";
                        } else {
                            $transport = str_replace(" ", "-", $transport);
                        }

                        $report["Transport $transport"] += 1;
                        if ($sheet['patient_city']) {
                            $report['bases'][$sheet['patient_city']]['transport'][$transport] += 1;
                        }
                    }
                }
            }
        }

        if (isset($sheet["support_transport_motolancia"])) {
            if ($sheet["support_transport_motolancia"]) $report['Apoio MT'] += 1;
        }
        if (isset($sheet["support_transport_usa"])) {
            if ($sheet["support_transport_usa"]) $report['Apoio USA'] += 1;
        }
        if (isset($sheet["support_transport_usb"])) {
            if ($sheet["support_transport_usb"]) $report['Apoio USB'] += 1;
        }
    };

    return $report;
}

function statistic_tratament_02($data, $locales)
{
    $response = [
        "m" => 0,
        "f" => 0,
        "ig" => 0,
        "ni" => 0,
        "better_1_age" => 0,
        "RN" => 0,
        "child_month" => 0,
        "1_11_age" => 0,
        "12_17_age" => 0,
        "18_40_age" => 0,
        "41_59_age" => 0,
        "60_79_age" => 0,
        "larger_80_age" => 0,
        "ignored_age" => 0,
        "not_informed_age" => 0
    ];

    foreach ($locales as $local) {
        $response[$local["locale"]] = 0;
    }

    foreach ($data as $sheet) {
        if (sizeof($sheet["victims"])  > 0) {
            foreach ($sheet["victims"] as $victim) {
                switch ($victim["gender"]) {
                    case "M": {
                            $response["m"] += 1;
                            break;
                        }
                    case "F": {
                            $response["f"] += 1;
                            break;
                        }
                    case "IG": {
                            $response["ig"] += 1;
                            break;
                        }
                    case "NI": {
                            $response["ni"] += 1;
                            break;
                        }
                }
                
                if ($victim["age_group"] == 'Criança' && $victim["is_month"] == '1') {
                    $response["child_month"] += 1;
                
                }else if ($victim["age"] && $victim["age"] != "IG" && $victim["age"] != "NI") {
                    $age_group = intval($victim["age_group"]);
                    $age = intval($victim["age"]);

                    if ($age >= 1 && $age <= 11) {
                        if ($age_group == "RN") {
                            $response["better_1_age"] += 1;
                        } else {
                            $response["1_11_age"] += 1;
                        }
                    }

                    if ($age >= 12 && $age <= 17) $response["12_17_age"] += 1; // Adolescente
                    if ($age >= 18 && $age <= 40) $response["18_40_age"] += 1; // Jovem
                    if ($age >= 41 && $age <= 59) $response["41_59_age"] += 1; // Adulto
                    if ($age >= 60 && $age <= 79) $response["60_79_age"] += 1; // Idoso
                    if ($age >= 80) $response["larger_80_age"] += 1;
                } else {
                    if ($victim["age"] == "IG") $response["ignored_age"] += 1;
                    if ($victim["age"] == "NI") $response["not_informed_age"] += 1;
                }
            }
        }

        if ($sheet["local"]) {
            $response[$sheet["local"]["locale"]] += 1;
        }
    }
    return $response;
}

function statistic_tratament_03off($list, $emergencies, $turn)
{
    $data = array();
    $emergencies = $emergencies->toArray(); // Lista de emergências

    foreach ($list as $field => $value) {

        if ($value->emergency_type) {

            $emergencyIndex = array_search($value->emergency_type->emergency_id, array_column($emergencies, 'id'));
            $emergencyCategory = $emergencies[$emergencyIndex]['emergency'];

            if (!isset($data[$emergencyCategory])) {

                $data[$emergencyCategory] = array(); // Inicializar

                if ($value->emergency_type->emergency_type) {
                    $data[$emergencyCategory][$value->emergency_type->emergency_type] = array(
                        'extraNight' => 0,
                        'morning' => 0,
                        'afternoon' => 0,
                        'night' => 0
                    );
                } else {
                    $data[$emergencyCategory] = array( // Se não tiver sub-emergência
                        'extraNight' => 0,
                        'morning' => 0,
                        'afternoon' => 0,
                        'night' => 0
                    );

                    $data[$emergencyCategory][$turn] = $value->total;
                }

                $data[$emergencyCategory][$value->emergency_type->emergency_type][$turn] = $value->total;
            } else {

                if (!isset($data[$emergencyCategory][$value->emergency_type->emergency_type])) {
                    $data[$emergencyCategory][$value->emergency_type->emergency_type] = array(
                        'extraNight' => 0,
                        'morning' => 0,
                        'afternoon' => 0,
                        'night' => 0
                    );

                    $data[$emergencyCategory][$value->emergency_type->emergency_type][$turn] = $value->total;
                }
            }
        }
    }

    return $data;
}

function statistic_tratament_03($list, $emergencies, $emergencyTypes, $turn)
{
    $list->toArray();
    $list = $list[0];

    $list = json_decode($list, true);

    $data = array();
    $emergencies = $emergencies->toArray(); // Lista de emergências
    $emergencyTypes = $emergencyTypes->toArray(); // Lista de emergências

    foreach ($emergencies as $emergency) {
        $data[$emergency["emergency"]] = array();
    }

    foreach ($list as $key => $value) {
        if ($value) {

            $emergencyTypeIndex = array_search($key, array_column($emergencyTypes, 'emergency_type'));
            $emergency = $emergencyTypes[$emergencyTypeIndex]["emergency_id"];

            $emergencyName = $emergencies[$emergency - 1]["emergency"];

            $data[$emergencyName][$key] = $value;
        }
    }

    return $data;
}

function statistic_tratament_04($data)
{
    $data = $data[0]->toArray();
    foreach ($data as $field => $value) {
        if ($value == null) $data[$field] = 0;
        else $data[$field] = intval($data[$field]);
    }
    return $data;
}


function statistic_tratament_agroup_items($report_global)
{ // Quando não tem subarray

    $group = array();
    $turns = ['morning', 'afternoon', 'night', 'extraNight'];

    foreach ($turns as $turn) {

        foreach ($report_global[$turn] as $key => $value) {

            if (!isset($group[$key])) {

                $group[$key] = array(
                    'extraNight' => 0,
                    'morning' => 0,
                    'afternoon' => 0,
                    'night' => 0,
                    'total' => 0
                );

                $group[$key][$turn] = intval($value);
                $group[$key]['total'] = intval($value);
            } else {

                $group[$key][$turn] = intval($value);
                $group[$key]['total'] += intval($value);
            }
        }
    }

    foreach ($turns as $turn) unset($report_global[$turn]);

    $report_global['report'] = $group;
    return $report_global;
}

function statistic_tratament_agroup_turns($report_global, $nameGroup)
{ // Agrupar por chaves e não por turnos

    $totalGroup = array();
    $turns = ['morning', 'afternoon', 'night', 'extraNight'];

    foreach ($report_global as $turnName => $turn) {

        foreach ($turn as $info => $values) {

            if ($info == $nameGroup) {

                foreach ($values as $key => $value) {

                    if (!isset($totalGroup[$key])) {

                        $totalGroup[$key] = array(
                            'extraNight' => 0,
                            'morning' => 0,
                            'afternoon' => 0,
                            'night' => 0,
                            'total' => 0
                        );

                        $totalGroup[$key][$turnName] = $value;
                        $totalGroup[$key]['total'] = $value;
                    } else {

                        $totalGroup[$key][$turnName] = $value;
                        $totalGroup[$key]['total'] += $value;
                    }
                }
            }
        }
    }

    foreach ($turns as $turn) {
        unset($report_global[$turn][$nameGroup]);
    }

    $newKey = $nameGroup .  "Total";

    $report_global[$newKey] = $totalGroup;

    return $report_global;
}

function statistic_totals($turn1, $turn2, $turn3, $turn4)
{
    $total = array();
    foreach ($turn1 as $key => $value) {
        if (!isset($total[$key])) $total[$key] = $value;
        else $total[$key] += $value;
    }

    foreach ($turn2 as $key => $value) {
        if (!isset($total[$key])) $total[$key] = $value;
        else $total[$key] += $value;
    }

    foreach ($turn3 as $key => $value) {
        if (!isset($total[$key])) $total[$key] = $value;
        else $total[$key] += $value;
    }

    foreach ($turn4 as $key => $value) {
        if (!isset($total[$key])) $total[$key] = $value;
        else $total[$key] += $value;
    }

    return $total;
}

function statistic_tratament_agroup_other_destinations($destinations)
{
    $data = [];

    foreach ($destinations as $destiny) {
        $data[$destiny["other_transfer_destiny"]] = $destiny["total"];
    }

    return $data;
}

function concat_timestamps($text)
{
    $date = date('d-m-Y h:i:s');
    $date = str_replace("-", "", $date);
    $date = str_replace(" ", "", $date);
    $date = str_replace(":", "", $date);
    return $text . "-" . $date;
}

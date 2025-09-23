/* Comando para preencher a tabela de vítimas */
INSERT INTO victims(
name, complaint, contact, age, gender, address, address_number, address_district, address_reference_point,
address_city, duration, blood_pressure, heart_rate, respiratory_frequency, oxigen_saturation, pulse,
hgt, others, acute_pain, diagnostic_hypothesis, conduct, how_much_time, estate, remedy_consult, observations,
pregnant_gestational_age, pregnant_parity, pregnant_single_pregnancy, pregnant_pa, pregnant_bcf,
pregnant_womb_dynamic, pregnant_fetal_movement, pregnant_vaginal_touch, eye_opening, verbal_response,
motor_response, emergency_id, emergency_type_id, severity_id, sheet_protocol, created_at, updated_at,deleted_at)
(SELECT patient_name, complaint, patient_contact, patient_age, patient_gender, patient_address,
patient_number, patient_district, patient_reference_point, patient_city, duration,
patient_blood_pressure, patient_heart_rate, patient_respiratory_frequency, 
patient_oxigen_saturation, patient_pulse, patient_hgt, patient_others, patient_acute_pain,
diagnostic_hypothesis, conduct, how_much_time, patient_estate, remedy_consult, observations,
pregnant_gestational_age, pregnant_parity, pregnant_single_pregnancy, pregnant_pa,
pregnant_bcf, pregnant_womb_dynamic, pregnant_fetal_movement, pregnant_vaginal_touch,
eye_opening, verbal_response, motor_response, emergency_id, emergency_type_id, severity_id,
protocol, created_at, updated_at, deleted_at FROM sheets);

/* Comando para remover as Usas 03 04 e 05 */
UPDATE transports SET deleted_at = CURRENT_TIMESTAMP() WHERE id IN (5,6,7);
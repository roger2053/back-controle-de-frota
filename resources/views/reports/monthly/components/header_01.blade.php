<div class="header-report">
                
    <img class="logo-sus" src="assets/img/logosus.png">
    <p class="label-left">Ministério da Saúde</p>
    <div class="label-left">
        <strong>SISTEMA DE INFORMAÇÃO AMBULATORIAL – SIA/SUS<br>Boletim de Produção Ambulatorial / BPA (consolidado)</strong>
    </div>
    <div class="label-folha">
        <strong>FOLHA 1</strong>
    </div>
    <br><br>
    <hr>

    <div style="display: table; border-spacing: 20px 0px;">
        <div style="display: table-cell;"> 
            <label><strong>Municipio</strong></label>
            <div class="width: 100px;">
                <div class="div-bordered label-left">
                    Senhor do Bonfim
                </div>
            </div>
        </div>

        <div style="display: table-cell; border-spacing: 2px;">
            <label><strong>CNES do estabelecimento</strong></label>
            <div style="width: 180px; display: table;">
                <div style="display: table-row; height: 100px;">
                    @foreach($cnes as $character)
                        <div class="div-cell">
                            {{ $character }}
                        </div>    
                    @endforeach
                </div>
            </div>
        </div>

        <div style="display: table-cell;"> 
            <label><strong>Nome do Estabelecimento de Saúde</strong></label>
            <div class="width: 100px;">
                <div class="div-bordered label-left">
                    SAMU - CENTRAL DE REGULAÇÃO DAS URGÊNCIAS 
                </div>
            </div>
        </div>

        <div style="display: table-cell; border-spacing: 2px;">
            <label><strong>Mês</strong></label>
            <div style="width: 70px; display: table;">
                <div style="display: table-row; height: 100px;">
                    <div class="div-cell">
                        {{ $month[0] }}
                    </div>
                    <div class="div-cell">
                        {{ $month[1] }}
                    </div>
                </div>
            </div>
        </div>
         
        <div></div>

        <div style="display: table-cell; border-spacing: 2px; margin: 5px;">
            <label><strong>Ano</strong></label>
            <div style="width: 140px; display: table;">
                <div style="display: table-row; height: 100px;">
                    <div class="div-cell">
                        {{ $year[0] }}
                    </div>
                    <div class="div-cell">
                        {{ $year[1] }}
                    </div>
                    <div class="div-cell">
                        {{ $year[2] }}
                    </div>
                    <div class="div-cell">
                        {{ $year[3] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>


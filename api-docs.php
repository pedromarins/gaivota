<?php include("_header.php") ?>

    <section class="banner api">
        <h2>API</h2>
    </section>
    <section class="content-block api-content">
    	<div>
        	<h3 class="content-title">Para que serve?</h3>
            <p class="api-text">API é uma interface que recebe requisições e retorna dados. Ela serve para automatizar envio e recebimento de dados. A API da Gaivota é utilizada tanto para receber dados das Estações como para fornecer dados estruturados à usuários. Com acesso aos dados, qualquer um pode realizar pesquisas e criar aplicações conforme sua própria demanda de forma independente.</p>

            <h3 class="content-title">Como acessar?</h3>
            <p class="api-text">O acesso ao envio de dados pela API é restrito às Estações cadastradas. Os pacotes de envio de dados devem conter um campo 'id' com o hash fornecido na criação da Estação.<br>Já a leitura de dados é aberta e pública para qualquer usuário, que pode acessar o endereço da API enviando parâmetros para receber respostas específicas.</p>

            <p class="api-code">http://gaivota.org/api.php</p>

            <p class="api-text">Para realizar buscas específicas na API devem ser passados parâmetros e valores seguindo o seguinte padrão:</p>

            <p class="api-code">http://gaivota.org/api.php?[PARAMETRO]=[VALOR]&[PARAMETRO2]=[VALOR]</p>

            <p class="api-text">Abaixo são listados os parâmetros e seus valores que podem ser utilizadas na API Gaivota.</p>

            <ul class="api-query">
                <li>
                    <div>
                        <p class="query-description">Buscar dados de uma estação específica.</p>
                        <p class="query-param">station_id</p>
                        <p class="query-volume">station number</p>
                    </div>
                    <p class="query-url"><span>Exemplo:</span> <a href="http://gaivota.org/api.php?station_id=1">http://gaivota.org/api.php?station_id=1</a> - retorna todos os dados da estação 1</p>
                </li>
                <li>
                    <div>
                        <p class="query-description">Buscar dados com recorte temporal.</p>
                        <p class="query-param">volume</p>
                        <p class="query-volume">mostrecent</p>
                    </div>
                    <p class="query-url"><span>Exemplo:</span> <a href="http://gaivota.org/api.php?volume=mostrecent">http://gaivota.org/api.php?volume=mostrecent</a> - retorna os dados mais recentes de todas as estações.</p>
                </li>
                <li>
                    <div>
                        <p class="query-description">Buscar estações de um determinado tipo.</p>
                        <p class="query-param">type</p>
                        <p class="query-volume">settled<br>portable<br>floater</p>
                    </div>
                    <p class="query-url"><span>Exemplo:</span> <a href="http://gaivota.org/api.php?type=settled">http://gaivota.org/api.php?type=settled</a> - retorna os dados de todas as estações fixas.</p>
                </li>          
                <li>
                    <div>
                        <p class="query-description">Adiciona um campo adicional de data e hora com o formato solicitado.</p>
                        <p class="query-param">time</p>
                        <p class="query-volume">ISO<br>human</p>
                    </div>
                    <p class="query-url"><span>Exemplo:</span> <a href="http://gaivota.org/api.php?time=human">http://gaivota.org/api.php?time=human</a> - retorna os dados adicionando um campo com data e hora em um formato mais legível por humanos.</p>
                </li>         
                <li>
                    <div>
                        <p class="query-description">Faz requisição cross-server para processamento de dados em remixes e retorna um jsonp.</p>
                        <p class="query-param">callback</p>
                        <p class="query-volume">true</p>
                    </div>
                    <p class="query-url"><span>Exemplo:</span> <a href="http://gaivota.org/api.php?callback=true">http://gaivota.org/api.php?callback=true</a> - retorna os dados dentro de uma função javaScript possibilitando leitura ao vivo por páginas hospedadas em servidores de terceiros.</p>
                </li>
            </ul>

        </div>
    </section>

<?php include("_footer.php") ?>

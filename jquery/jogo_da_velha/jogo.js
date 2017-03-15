var rodada = 1;
var matriz_jogo = Array(3);

matriz_jogo['a'] = Array(3);
matriz_jogo['b'] = Array(3);
matriz_jogo['c'] = Array(3);

matriz_jogo['a'][1] = 0;
matriz_jogo['a'][2] = 0;
matriz_jogo['a'][3] = 0;
matriz_jogo['b'][1] = 0;
matriz_jogo['b'][2] = 0;
matriz_jogo['b'][3] = 0;
matriz_jogo['c'][1] = 0;
matriz_jogo['c'][2] = 0;
matriz_jogo['c'][3] = 0;

$(document).ready(function () {

    $('#btn_iniciar_jogo').click(function () {

        // valida a digitação dos apelidos
        var jogador1 = $('#entrada_apelido_jogador_1').val();
        var jogador2 = $('#entrada_apelido_jogador_2').val();

        if (jogador1 == '') {
            alert('Apelido do jogador 1 não foi preenchido');
            return false;
        }
        if (jogador2 == '') {
            alert('Apelido do jogador 2 não foi preenchido');
            return false;
        }

        // exibir os apelidos
        $('#nome_jogador_1').append(jogador1);
        $('#nome_jogador_2').append(jogador2);

        // exibir palco_jogo
        $('#pagina_inicial').hide();
        $('#palco_jogo').show();

    });

    // controlando jogadas do jogo da velha
    $('.jogada').click(function () {
        // pegando ID do campo que foi clicado no jogo da velha
        var id_campo_clicado = this.id;
        jogada(id_campo_clicado);
    });

    function jogada(id) {
        var icone = '';
        var ponto = 0;

        if ((rodada % 2) == 1) {
            // vez do jogador 1 --> vai marcar -1 na matriz
            icone = 'url("imagens/marcacao_1.png")';
            ponto = -1;
        } else {
            // vez do jogador 2 --> vai marcar 1 na matriz
            icone = 'url("imagens/marcacao_2.png")';
            ponto = 1;
        }
        rodada++;

        $('#' + id).css({ 'background-image': icone });

        // separando o valor do ID para saber em que chave do Array() vai entrar
        // exemplo a-1 --> linha 'a' coluna '1'
        var linha_coluna = id.split('-');
        matriz_jogo[linha_coluna[0]][linha_coluna[1]] = ponto;

        verificaCombinacao();
    }

    function verificaCombinacao() {
        // verifica na horizontal
        var pontos = 0;
        for (var i = 1; i <= 3; i++) {
            pontos = pontos + matriz_jogo['a'][i];
        }
        ganhador(pontos);

        pontos = 0;
        for (var i = 1; i <= 3; i++) {
            pontos = pontos + matriz_jogo['b'][i];
        }
        ganhador(pontos);

        pontos = 0;
        for (var i = 1; i <= 3; i++) {
            pontos = pontos + matriz_jogo['c'][i];
        }
        ganhador(pontos);

        // verificar na vertical
        for (var l = 1; l <= 3; l++) {
            pontos = 0;
            pontos = pontos + matriz_jogo['a'][l];
            pontos = pontos + matriz_jogo['b'][l];
            pontos = pontos + matriz_jogo['c'][l];
            ganhador(pontos);
        }

        // verificar na diagonal
        pontos = 0;
        pontos = matriz_jogo['a'][1] + matriz_jogo['b'][2] + matriz_jogo['c'][3];
        ganhador(pontos);

        pontos = 0;
        pontos = matriz_jogo['a'][3] + matriz_jogo['b'][2] + matriz_jogo['c'][1];
        ganhador(pontos);
    }

    function ganhador(pontos) {
        console.log(pontos);
        if (pontos == -3) {
            var jodador_1 = $('#entrada_apelido_jogador_1').val();
            alert(jodador_1 + ' é o vencedor');
        } else if (pontos == 3) {
            var jodador_2 = $('#entrada_apelido_jogador_2').val();
            alert(jodador_2 + ' é o vencedor');
        }
    }

});
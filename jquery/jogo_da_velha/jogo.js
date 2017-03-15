var rodada = 1;
var matriz_jogo = Array(3);

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
    }

});
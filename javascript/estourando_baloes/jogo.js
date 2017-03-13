function iniciaJogo() {
    //alert('jogo iniciado');

    /*
     ** 1 fácil -> 120 segundos
     ** 2 normal -> 60 segundos
     ** 3 dificil -> 30 segundos
     */

    var url = window.location.search; //pega só a parte do queryString (parametro URL)
    var nivel_jogo = url.replace("?", "");
    var tempo_segundos = 0;

    if (nivel_jogo == 1) {
        tempo_segundos = 120;
    } else if (nivel_jogo == 2) {
        tempo_segundos = 60;
    } else if (nivel_jogo == 3) {
        tempo_segundos = 30;
    }

    // inserindo segundos no span do cronometro
    document.getElementById('cronometro').innerHTML = tempo_segundos;

    // qtd de bolões
    var qtdeBaloes = 10;
    criaBaloes(qtdeBaloes);

    // imprimir qtde baloes inteiros e estourados
    document.getElementById('baloes_inteiros').innerHTML = qtdeBaloes;
    document.getElementById('baloes_estourados').innerHTML = 0;
}

function criaBaloes(qtdeBaloes) {
    for (var i = 1; i <= qtdeBaloes; i++) {
        var balao = document.createElement('img');
        balao.src = 'imagens/balao_azul_pequeno.png';
        balao.style.margin = '10px';

        //adicionando balao como sendo um filho da div#cenario [appendChild]
        document.getElementById('cenario').appendChild(balao);
    }
}
var timerId = null; // varialvel que armazena a chamada da funcao timeout

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
    var qtdeBaloes = 80;
    criaBaloes(qtdeBaloes);

    // imprimir qtde baloes inteiros e estourados
    document.getElementById('baloes_inteiros').innerHTML = qtdeBaloes;
    document.getElementById('baloes_estourados').innerHTML = 0;

    // dinamica no cronometro
    contagemTempo(tempo_segundos + 1);
}

function contagemTempo(segundos) {
    segundos = segundos - 1;
    if (segundos == -1) {
        clearTimeout(timerId); // para a execução da funcao do setTimeout
        gameOver();
        return false;
    }
    document.getElementById('cronometro').innerHTML = segundos;
    timerId = setTimeout("contagemTempo(" + segundos + ")", 1000);
}

function gameOver() {
    alert('Fim de jogo, você não conseguiu estourar todos os balões a tempo');
}

function criaBaloes(qtdeBaloes) {
    for (var i = 1; i <= qtdeBaloes; i++) {
        var balao = document.createElement('img');
        balao.src = 'imagens/balao_azul_pequeno.png';
        balao.style.margin = '10px';
        balao.id = 'b' + i;
        balao.onclick = function () { estourar(this); }; // no click substituir img do balão

        //adicionando balao como sendo um filho da div#cenario [appendChild]
        document.getElementById('cenario').appendChild(balao);
    }
}

function estourar(e) {
    var id_balao = e.id;
    document.getElementById(id_balao).setAttribute("onclick", "");// eliminando possibilidade de clicar em um balão já estourado
    document.getElementById(id_balao).src = 'imagens/balao_azul_pequeno_estourado.png';
    pontuacao(-1); // cada balão estoura é -1 inteiro
}

function pontuacao(acao) {
    var baloes_inteiros = document.getElementById('baloes_inteiros').innerHTML;
    var baloes_estourados = document.getElementById('baloes_estourados').innerHTML;

    baloes_inteiros = parseInt(baloes_inteiros);
    baloes_estourados = parseInt(baloes_estourados);

    baloes_inteiros = baloes_inteiros + acao;
    baloes_estourados = baloes_estourados - acao;

    document.getElementById('baloes_inteiros').innerHTML = baloes_inteiros;
    document.getElementById('baloes_estourados').innerHTML = baloes_estourados;

    situacaoJogo(baloes_inteiros); // verifica se o jogo acabou ou não
}

function situacaoJogo(baloes_inteiros) {
    if (baloes_inteiros == 0) {
        alert('Parabens você conseguiu estourar todos os balões');
        pararJogo(); // para o tempo do cronometro
    }
}

function pararJogo() {
    clearTimeout(timerId);
}
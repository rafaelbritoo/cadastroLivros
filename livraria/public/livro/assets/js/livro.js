$(document).ready(function () {
    // Função para formatar o valor com a máscara
    function formatarValor(valor) {
        valor = valor.replace(/[^0-9]/g, ''); // Remove caracteres não numéricos
        valor = (valor / 100).toFixed(2); // Divide por 100 para formar o valor correto
        valor = valor.replace('.', ','); // Substitui ponto por vírgula
        valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Adiciona separador de milhar
        return valor;
    }

    // Aplica a máscara no campo de valor na inicialização
    $('#valor').val(function () {
        let valor = $(this).val();
        return formatarValor(valor); // Formata o valor com a máscara
    });

    // Máscara para o campo valor enquanto o usuário digita
    $('#valor').on('input', function () {
        let value = $(this).val();
        $(this).val(formatarValor(value));
    });
});

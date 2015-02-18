function Banco() {

    var self = this;

    this.clear = function (e) {
        e.preventDefault();
        $('#lstData').show();
        $('#lstSearch, #searchClean').hide();
        $('#textNome').focus();
    };

    this.search = function (e) {
        e.preventDefault();
        $('#searchTerm').html($('#textNome').val());
        var msg = MyCookieJS.execute('banco/search', $('#FrmSearch').serialize(), false);
        $('#lstData').hide();
        $('#lstSearch, #searchClean').show();
        $('#lstSearchData').html(msg);
        $('#FrmSearch')[0].reset();
    };
    
    this.searchTransacoes = function (e) {
        e.preventDefault();
        $('#searchTerm').html($('#textNome').val());
        var msg = MyCookieJS.execute('banco/searchTransacoes', $('#FrmSearch').serialize(), false);
        $('#lstData').hide();
        $('#lstSearch, #searchClean').show();
        $('#lstSearchData').html(msg);
        $('#FrmSearch')[0].reset();
    };

    this.deleteTransacao = function (e) {
        e.preventDefault();
        MyCookieJS.confirm('Tem certeza que deseja deletar esta transação?', function () {
            var msg = MyCookieJS.execute('banco/deleteTransacao', $('#FrmEdit').serialize(), false);
            MyCookieJS.alert(msg, function () {
                MyCookieJS.goto('administrator/banco');
            });
        });
    };

    this.submitDeposito = function (e) {
        e.preventDefault();
        var msg = MyCookieJS.execute('banco/saveDeposito', $('#FrmEdit').serialize(), false);
        MyCookieJS.alert(msg, function () {
            MyCookieJS.goto('administrator/banco');
        });
    };
    
    this.submitRetirada = function (e) {
        e.preventDefault();
        var msg = MyCookieJS.execute('banco/saveRetirada', $('#FrmEdit').serialize(), false);
        MyCookieJS.alert(msg, function () {
            MyCookieJS.goto('administrator/banco');
        });
    };
}

var banco = new Banco();
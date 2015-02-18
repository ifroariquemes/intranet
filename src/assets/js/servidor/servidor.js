function Servidor() {

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
        var msg = MyCookieJS.execute('servidor/search', $('#FrmSearch').serialize(), false);
        $('#lstData').hide();
        $('#lstSearch, #searchClean').show();
        $('#lstSearchData').html(msg);
        $('#FrmSearch')[0].reset();
    };
    
    this.active = function (e) {
        e.preventDefault();
            MyCookieJS.confirm('Tem certeza que deseja reativar o servidor?', function () {
            var msg = MyCookieJS.execute('servidor/active', $('#FrmEdit').serialize(), false);
            MyCookieJS.alert(msg, function () {
                MyCookieJS.goto('administrator/servidor');
            });
        });
    };

    this.deactive = function (e) {
        e.preventDefault();
            MyCookieJS.confirm('Tem certeza que deseja desativar o servidor?<div class="alert-danger">Ele não aparecerá nos relatórios</div>', function () {
            var msg = MyCookieJS.execute('servidor/deactive', $('#FrmEdit').serialize(), false);
            MyCookieJS.alert(msg, function () {
                MyCookieJS.goto('administrator/servidor');
            });
        });
    };

    this.submit = function (e) {
        e.preventDefault();
        var exists = MyCookieJS.execute('servidor/exists', $('#FrmEdit').serialize(), false);
        if (exists != '') {
            alert(exists);
        } else {
            var msg = MyCookieJS.execute('servidor/save', $('#FrmEdit').serialize(), false);
            MyCookieJS.alert(msg, function () {
                MyCookieJS.goto('administrator/servidor');
            });
        }
    };
}

var servidor = new Servidor();
<div class="modal" id="mdConfirmed">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e('Nova senha', 'user') ?></h4>
            </div>            
            <form id="FrmForgot" onsubmit="user.forgotConf(event, '<?= filter_input(INPUT_GET, 'return') ?>')">
                <div class="modal-body">                                                                                        
                    <fieldset>
                        <div class="form-group">
                            <label for="textName"><?php _e('Name', 'user') ?>*:</label>                            
                            <br><?php echo $data->getCompleteName() ?>
                        </div> 
                        <div class="form-group">
                            <label for="textNewPassword"><?php _e('New password', 'user') ?>:</label>                            
                            <input required="required" pattern=".{6,32}" onchange="user.event_onChangePassword()" type="password" name="newPassword" id="textNewPassword" class="form-control" value="">                            
                        </div>
                        <div class="form-group">
                            <label for="textPasswordRepeat"><?php _e('Repeat new password', 'user') ?>:</label>                            
                            <input required="required" type="password" onchange="user.event_onChangePassword()" name="passwordRepeat" id="textPasswordRepeat" class="form-control" value="">                            
                        </div>
                    </fieldset>
                    <input type="hidden" name="key" value="<?= filter_input(INPUT_GET, 'key') ?>">
                </div>                
                <div class="modal-footer">                
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> <?php _e('Alterar senha', 'user') ?></button>
                </div>            
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    require(['jquery'], function($) {
        $(function() {
            $('#mdConfirmed').modal({
                'show': true,
                'keyboard': false,
                'backdrop': false
            });
            $('#textNewPassword').focus();
        });
    });
</script>
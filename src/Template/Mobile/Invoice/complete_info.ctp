<div class="wraper">
    <div class="invoic_type_header bgff">
        <div class="invoic_type" id="invoictab">
            <span>普通发票</span>
            <span>增值税发票</span>
            <div class='botttomline'></div>
        </div>
    </div>
    <div class='invoic_tab' style="padding-top:1rem;">
        <div class="invoic_tab_box">
            <section>
                <form action="" method="post" id="general">
                    <input type="hidden" name="is_VAT" value="2" />
                    <div class="invoic_company_detail bgff border">
                        <div class="innerwaper">
                            <ul>
                                <li class="bd1">
                                    <span class="pay_left_block">公司名称</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写公司名称" value="<?= $user->company ?>" name="company" />
                                    </div>
                                </li>
                                <li>
                                    <span class="pay_left_block">发票金额</span>
                                    <div class="pay_right_info">
                                        <i class="color-items"><?= $user->invoice_money ?></i>元
                                        <input type="hidden" name="sum" value="<?= $user->invoice_money ?>" />
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="h2"></div>
                    <div class="invoic_self_detail bgff border">
                        <div class="innerwaper">
                            <ul>
                                <li class="bd1">
                                    <span class="pay_left_block">收件人</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写收件人" value="<?= $user->truename ?>" name="recipient" />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">联系电话</span>
                                    <div class="pay_right_info">
                                        <input type="text" value='<?= $user->phone ?>' name="recipient_phone" />
                                    </div>
                                </li>
                                <li>
                                    <span class="pay_left_block">收件地址</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写收件地址" name="recipient_address" value="<?= $user->address ? $user->address : '' ?>" />
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>
            <section>
                <form action="" method="post" id="not_general">
                    <input type="hidden" name="is_VAT" value="1" />
                    <div class="invoic_company_detail bgff border">
                        <div class="innerwaper">
                            <ul>
                                <li class="bd1">
                                    <span class="pay_left_block">公司名称</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写公司名称" value="<?= $user->company ?>" name="company" />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">纳税人识别号</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写纳税人识别号" name="registration_num" value="<?= $user->registration_num ? $user->registration_num : '' ?>" />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">公司地址</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写公司地址" name="company_address" value="<?= $user->company_address ? $user->company_address : '' ?>" />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">公司电话</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写公司电话" name="company_phone" value="<?= $user->company_phone ? $user->company_phone : '' ?>" />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">开户行</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写开户银行" name="bank" value="<?= $user->bank ? $user->bank : '' ?>" />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">开户账号</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写开户账号" name="bank_account" value="<?= $user->bank_account ? $user->bank_account : '' ?>" />
                                    </div>
                                </li>
                                <li>
                                    <span class="pay_left_block">发票金额</span>
                                    <div class="pay_right_info">
                                        <i class="color-items"><?= $user->invoice_money ?></i>元
                                        <input type="hidden" name="sum" value="<?= $user->invoice_money ?>" />
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="h2"></div>
                    <div class="invoic_self_detail bgff border">
                        <div class="innerwaper">
                            <ul>
                                <li class="bd1">
                                    <span class="pay_left_block">收件人</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写收件人" value="<?= $user->truename ?>" name="recipient" />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">联系电话</span>
                                    <div class="pay_right_info">
                                        <input type="text" value='<?= $user->phone ?>' name="recipient_phone" />
                                    </div>
                                </li>
                                <li>
                                    <span class="pay_left_block">收件地址</span>
                                    <div class="pay_right_info">
                                        <input type="text" placeholder="请填写收件地址" name="recipient_address" <?= $user->address ? $user->address : '' ?> />
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <div class="reg-shadow" id="shadow" hidden></div>
    <div class="invoic_dialog" style="display:none">
        <div class="dialog_inner" hidden>
            <div class="invoic_dialog_head">
                <h3>确认发票信息</h3>
            </div>
            <div class="invoic_tab">
                <div class="invoic_self_detail bgff border">
                    <div class="innerwaper">
                        <ul>
                            <li class="bd1">
                                <span class="pay_left_block">公司名称</span>
                                <div class="pay_right_info">
                                    <input type="text" value="<?= $user->company ?>" readonly="readonly">
                                </div>
                            </li>
                            <li>
                                <span class="pay_left_block">发票金额</span>
                                <div class="pay_right_info">
                                    <i class="color-items"><?= $user->invoice_money ?></i>元
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="invoic_dialog_footer">
                <span class="quitbtn" id="no">取消</span>
                <span class="surebtn" id="yes">确认</span>
            </div>
        </div>
    </div>
    <div style='height:1.2rem;'></div>
    <a href="javascript:void(0)" class="f-bottom" id="submit" type="0">提 交</a>
</div>
<script type="text/javascript">
    $('#invoictab span').on('tap', function () {
        var index = $(this).index();
        console.log(index);
        $('#invoictab .botttomline').css('left', index * 50 + '%');
        $('.invoic_tab_box').css({'left': -index * 100 + '%'});
        $('#submit').attr('type', index);
    });
    var formData = '';
    $('#submit').on('tap', function () {
        var alert = 0;
        if ($(this).attr('type') == 0) {
            $('#general').find('input').each(function () {
                if ($(this).val() == '') {
                    $.util.alert('请填写全部内容');
                    alert ++;
                }
            });
            formData = $('#general').serialize();
        } else {
            $('#not_general').find('input').each(function () {
                if ($(this).val() == '') {
                    $.util.alert('请填写全部内容');
                    alert ++;
                }
            });
            formData = $('#not_general').serialize();
        }
        if(!alert){
            $('#shadow').show();
            $('.invoic_dialog').show();
            $('.dialog_inner').show();
        }
    });
    
    $('#yes').on('tap', function(){
        console.log(formData);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: formData,
            url: '/invoice/save-invoice',
            success: function (res) {
                if (res.status) {
                    window.location.href = '/invoice/success';
                } else {
                    $.util.alert(res.msg);
                }
                $('#shadow').hide();
                $('.invoic_dialog').hide();
                $('.dialog_inner').hide();
            }
        });
    });
    
    $('#no').on('tap', function(){
        $('#shadow').hide();
        $('.invoic_dialog').hide();
        $('.dialog_inner').hide();
    });
</script>

<div class="wraper">
    <?php if ($invoice->is_shipment != 1): ?>
        <div class="invoic_type_header toinvoic">
            <div class="color-items">待开票</div>
        </div>
    <?php endif; ?>
    <div class='invoic_tab' style="padding-top:.8rem;">
        <div class="invoic_tab_box">
            <section>
                <?php if ($invoice->is_shipment == 1): ?>
                    <div class="invoic_company_detail bgff border">
                        <div class="innerwaper">
                            <ul>
                                <li class="bd1">
                                    <span class="pay_left_block">快递公司</span>
                                    <div class="pay_right_info"> 
                                        <input type="text" value='<?= $invoice->shipment_express ?>' readonly="readonly"  />
                                    </div>
                                </li>
                                <li>
                                    <span class="pay_left_block">快递单号</span>
                                    <div class="pay_right_info">
                                        <input type="text" value="<?= $invoice->shipment_number ?>" readonly="readonly" />
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="h2"></div>
                <?php endif; ?>
                <div class="invoic_company_detail bgff border">
                    <div class="innerwaper">
                        <ul>
                            <li class="bd1">
                                <span class="pay_left_block" style="width:20%;"><?= $invoice->recipient ?></span>
                                <div class="pay_right_info" style="width:80%"> 
                                    <input type="text" value='<?= $invoice->recipient_phone ?>' readonly="readonly"  />
                                </div>
                            </li>
                            <li>
                                <div class="pay_right_info" style="width:100%">
                                    <input type="text" value="<?= $invoice->recipient_address ?>" readonly="readonly" />
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
                                <span class="pay_left_block">公司名称</span>
                                <div class="pay_right_info">
                                    <input type="text" value="<?= $invoice->company ?>" readonly="readonly" />
                                </div>
                            </li>
                            <?php if ($invoice->is_VAT == 1): ?>
                                <li class="bd1">
                                    <span class="pay_left_block">纳税人识别号</span>
                                    <div class="pay_right_info">
                                        <input type="text" value="<?= $invoice->registration_num ?>" readonly="readonly" />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">公司地址</span>
                                    <div class="pay_right_info">
                                        <input type="text" value="<?= $invoice->company_address ?>" readonly />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">公司电话</span>
                                    <div class="pay_right_info">
                                        <input type="text" value="<?= $invoice->company_phone ?>" readonly />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">开户行</span>
                                    <div class="pay_right_info">
                                        <input type="text" value="<?= $invoice->bank ?>" readonly />
                                    </div>
                                </li>
                                <li class="bd1">
                                    <span class="pay_left_block">开户账号</span>
                                    <div class="pay_right_info">
                                        <input type="text" value="<?= $invoice->bank_account ?>" readonly />
                                    </div>
                                </li>
                            <?php endif; ?>
                            <li class="bd1">
                                <span class="pay_left_block">发票金额</span>
                                <div class="pay_right_info">
                                    <i class="color-items"><?= $invoice->sum ?></i>元
                                </div>
                            </li>
                            <li >
                                <span class="pay_left_block">申请时间</span>
                                <div class="pay_right_info">
                                    <input type="text" value='<?= $invoice->create_time ?>' readonly="readonly"  />
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <ul class="invoic_history">
        <li>
            <a href="/invoice/include-order/<?= $invoice->id ?>" class="ablock">
                <div class="invoic_h_left">
                    <div><span class="price">所含订单</span></div>
                    <!--<time>2016.9.10  12:30-2016.10.10 12:30</time>-->
                </div>
                <div class="invoic_h_right">
                    <i class="iconfont">&#xe667;</i>
                </div>
            </a>
        </li>
</div>

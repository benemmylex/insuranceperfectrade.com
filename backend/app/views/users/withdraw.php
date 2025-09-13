<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Withdraw Fund
            <small>Withdraw fund from account</small>
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" id="msg">
                <?php echo $this->session->userdata('msg'); ?>
            </div>
        </div>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box no-border">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Withdrawal Methods
                        </div>
                    </div>
                    <div class="box-body bottom-pad-3x">
                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-danger no-border">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Pay To Bitcoin Wallet
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Bitcoin Wallet<span class="required">*</span></label>
                                            <input class="form-control bitcoin-details" id="bitcoin-wallet" type="text">
                                            <small class="text-muted">Eg. Coinbase, Blockchain, Coinmama etc.</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Wallet Address<span class="required">*</span></label>
                                            <input class="form-control bitcoin-details" id="bitcoin-address"
                                                type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Amount<span class="required">*</span></label>
                                            <input class="form-control" id="bitcoin-amount" type="number" step="0.01">
                                            <small class="text-muted">Should not be less than 50 USD</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Account Password<span class="required">*</span></label>
                                            <input class="form-control" id="bitcoin-password" type="password">
                                        </div>
                                        <button class="btn btn-primary btn-flat"
                                            onclick="withdraw_password($(this),___('bitcoin-amount'),'Bitcoin',__('bitcoin-details'),___('bitcoin-password'))">Book
                                            Withdrawal</button>
                                        <!-- <?php if (date('N') <= 5 && (date('G') >= 12 && date('G') <= 15)): ?>
                                            <button class="btn btn-primary btn-flat" onclick="withdraw_password($(this),___('bitcoin-amount'),'Bitcoin',__('bitcoin-details'),___('bitcoin-password'))">Book Withdrawal</button>
                                        <?php else: ?>
                                            <span class="text-red">Withdrawal is not available at the moment</span>
                                        <?php endif; ?> -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-success no-border">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Pay To Ethereum Wallet
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Ethereum Wallet<span class="required">*</span></label>
                                            <input class="form-control ethereum-details" id="ethereum-wallet"
                                                type="text">
                                            <small class="text-muted">Eg. Atomic Wallet, Metamask, Blockchain
                                                etc.</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Wallet Address<span class="required">*</span></label>
                                            <input class="form-control ethereum-details" id="ethereum-address"
                                                type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Amount<span class="required">*</span></label>
                                            <input class="form-control" id="ethereum-amount" type="number" step="0.01">
                                            <small class="text-muted">Should not be less than 50 USD</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Account Password<span class="required">*</span></label>
                                            <input class="form-control" id="ethereum-password" type="password">
                                        </div>
                                        <button class="btn btn-primary btn-flat"
                                            onclick="withdraw_password($(this),___('ethereum-amount'),'Ethereum',__('ethereum-details'),___('ethereum-password'))">Book
                                            Withdrawal</button>
                                        <!-- <?php if (date('N') <= 5 && (date('G') >= 12 && date('G') <= 15)): ?>
                                            <button class="btn btn-primary btn-flat" onclick="withdraw_password($(this),___('ethereum-amount'),'Ethereum',__('ethereum-details'),___('ethereum-password'))">Book Withdrawal</button>
                                        <?php else: ?>
                                            <span class="text-red">Withdrawal is not available at the moment</span>
                                        <?php endif; ?> -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-danger no-border">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Pay To USDT Wallet
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>USDT Wallet<span class="required">*</span></label>
                                            <input class="form-control usdt-details" id="perfect-wallet" type="text">
                                            <small class="text-muted">Eg. binance.com, trustwallet</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Wallet Address<span class="required">*</span></label>
                                            <input class="form-control usdt-details" id="usdt-address" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Amount<span class="required">*</span></label>
                                            <input class="form-control" id="usdt-amount" type="number" step="0.01">
                                            <small class="text-muted">Should not be less than 50 USD</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Account Password<span class="required">*</span></label>
                                            <input class="form-control" id="usdt-password" type="password">
                                        </div>
                                        <button class="btn btn-primary btn-flat"
                                            onclick="withdraw_password($(this),___('usdt-amount'),'USDT',__('usdt-details'),___('usdt-password'))">Book
                                            Withdrawal</button>
                                        <!-- <?php if (date('N') <= 5 && (date('G') >= 12 && date('G') <= 15)): ?>
                                        <button class="btn btn-primary btn-flat" onclick="withdraw_password($(this),___('usdt-amount'),'USDT',__('usdt-details'),___('usdt-password'))">Book Withdrawal</button>
                                        <?php else: ?>
                                        <span class="text-red">Withdrawal is not available at the moment</span>
                                        <?php endif; ?> -->
                                    </div>
                                </div>
                            </div>
                            <!--<div class="panel box box-danger no-border">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Pay To Perfect Money Wallet
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Perfect Wallet<span class="required">*</span></label>
                                            <input class="form-control perfet-details" id="perfect-wallet" type="text">
                                            <small class="text-muted">Eg. Perfectmoney.com</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Wallet Address<span class="required">*</span></label>
                                            <input class="form-control perfect-details" id="perfect-address" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Amount<span class="required">*</span></label>
                                            <input class="form-control" id="perfect-amount" type="number" step="0.01">
                                            <small class="text-muted">Should not be less than 50 USD</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Account Password<span class="required">*</span></label>
                                            <input class="form-control" id="perfect-password" type="password">
                                        </div>
                                        <button class="btn btn-primary btn-flat" onclick="withdraw_password($(this),___('perfect-amount'),'Perfect Money',__('perfect-details'),___('perfect-password'))">Book Withdrawal</button>
                                         <?php if (date('N') <= 5 && (date('G') >= 12 && date('G') <= 15)): ?>
                                        <button class="btn btn-primary btn-flat" onclick="withdraw_password($(this),___('perfect-amount'),'Perfect Money',__('perfect-details'),___('perfect-password'))">Book Withdrawal</button>
                                        <?php else: ?>
                                        <span class="text-red">Withdrawal is not available at the moment</span>
                                        <?php endif; ?> -->
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
</div>
<div class="alert alert-info">
    <i class="fa fa-info-circle"></i> Withdrawals are booked from 12pm - 4pm GMT Mon - Fri and it can take up to 24
    hours for your wallet to be funded
</div>
</div>
</div>
</section>
</div>
<!DOCTYPE html>
<?php
if ($this->session->userdata('site_lang') && in_array($this->session->userdata('site_lang'), json_decode($this->system->rtl_supported_language, true))) {
    $dir = 'rtl';
} else {
    $dir = 'ltr';
}
?>
<html dir='<?php echo $dir; ?>'>

<head>
    <?php $this->load->view($this->path_to_view_admin . 'header'); ?>
</head>

<body>
    <?php $this->load->view($this->path_to_view_admin . 'header_body'); ?>

    <div class="d-flex" id="wrapper">
        <?php $this->load->view($this->path_to_view_admin . 'sidebar'); ?>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        <?php echo $title; ?>
                    </h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <?php if (isset($btn)) { ?>
                            <a class="btn btn-sm btn-outline-secondary"
                                href="<?php echo base_url() . $this->path_to_view_admin; ?>wallet_offer/">
                                <i class="fa fa-eye"></i>
                                <?php echo $btn; ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-light text-dark">
                            <div class="card-header"><strong>Wallet Offer</strong></div>
                            <div class="card-body">
                                <form method="POST" id="validate" 
                                    action="<?php if ($Action == 'Add') { ?><?php echo base_url() . $this->path_to_view_admin ?>wallet_offer/insert<?php } elseif ($Action == 'Edit') { ?><?php echo base_url() . $this->path_to_view_admin ?>wallet_offer/edit<?php } ?>">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="offer_amount">Offer Amount (INR)<span class="required" aria-required="true"> *
                                                </span></label>
                                            <input type="number" class="form-control" name="offer_amount"
                                                value="<?php if (isset($offer_amount))
                                                    echo $offer_amount;
                                                elseif (isset($detail['offer_amount']))
                                                    echo $detail['offer_amount'] ?>">
                                            <?php echo form_error('offer_amount', '<em style="color:red">', '</em>'); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="extra_coins">Extra Coins<span class="required" aria-required="true"> *
                                                </span></label>
                                            <input type="number" class="form-control" name="extra_coins"
                                                value="<?php if (isset($extra_coins))
                                                    echo $extra_coins;
                                                elseif (isset($detail['extra_coins']))
                                                    echo $detail['extra_coins'] ?>">
                                            <?php echo form_error('extra_coins', '<em style="color:red">', '</em>'); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="custom-control custom-checkbox pt-4">
                                                <input type="checkbox" class="custom-control-input" id="is_best_deal" name="is_best_deal" value="1" <?php echo (isset($detail['is_best_deal']) && $detail['is_best_deal'] == 1) ? 'checked' : ''; ?>>
                                                <label class="custom-control-label" for="is_best_deal">Is Best Deal?</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id"
                                            value="<?php echo (isset($detail['id'])) ? $detail['id'] : ''; ?>">
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" value="Submit" name="submit" class="btn btn-primary ">
                                        <a class="btn btn-secondary"
                                            href="<?php echo base_url() . $this->path_to_view_admin; ?>wallet_offer/"
                                            name="cancel">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view($this->path_to_view_admin . 'footer_body'); ?>
        </div>
    </div>
    <?php $this->load->view($this->path_to_view_admin . 'footer'); ?>
    <script>
        $(document).ready(function () {
            $("#validate").validate({
                rules: {
                    'offer_amount': {
                        required: true,
                        number: true
                    },
                    'extra_coins': {
                        required: true,
                        number: true
                    },
                },
                messages: {
                    'offer_amount': {
                        required: 'Offer amount is required',
                    },
                    'extra_coins': {
                        required: 'Extra coins is required',
                    },
                }
            });
        });
    </script>
</body>

</html>

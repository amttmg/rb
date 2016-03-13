<script src="<?php echo base_url() ?>template/plugins/print/jquery-1.8.3.js"></script>
<script src="<?php echo base_url() ?>template/plugins/print/jquery.printElement.js"></script>
<style>

    /* .print_area{background-image:url(../assets/image/resampledimage_front.jpg);}*/
    .aa {
        margin: 0px auto;
        width: 300px;
    }

    *

    /
</style>
<div class="aa">
    <p><button id="print_btn" >Print</button></p>

        <div id="print" class="print_area" style="width:336px; margin: 0px auto; height:100px;font-weight:400;">
            <div class="dataprint" id="dataprint"
                 style="float:right; margin-top:100px; color:#000; margin-right:10px; letter-spacing: 2px;">
                <?php echo $card->card_no; ?><br/>
                <?php echo $customer->fname; ?><br/>
                <?php echo $customer->lname; ?>&nbsp;<?php echo $customer->email; ?><br/>
                <?php echo $customer->dob; ?><br/>
                <?php echo $customer->dob; ?><br/>
            </div>
        </div>

</div>

<script>
    $("#print_btn").click(function (e) {
        $("#print").printElement({
            overrideElementCSS: [
                '../css/printing.css',
                {href: '../css/printing.css', media: 'print'}]
        });
    });
</script>
</html>

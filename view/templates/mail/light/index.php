<div class="previewMail" style="display: block;position: relative;width: 100%;height: auto;background-color: #fff;border: 1px solid #eaeaea;">
    <div class="pmTop" style="display: block;position: relative;border-bottom: 1px solid #eaeaea;padding: 15px;text-align: center;">
        <a href="<?php echo $pmLink; ?>" target="_blank" style="color: #10a98d;text-decoration: underline;">View this promo download page</a>
    </div>
    <table class="pmContent" style="display: block;position: relative;width: 60%;margin: 0 auto;padding: 30px 15px;padding-bottom: 15px;border-left: 1px solid #eaeaea;border-right: 1px solid #eaeaea;">
        <tr>
            <td class="pmImg" style="display: inline-block;width: 35%;height: auto;vertical-align: top;">
                <img src="<?php echo $pmCover; ?>" style="width: 100%;height: auto;">
            </td>
            <td class="pmBody" style="display: inline-block;width: 60%;height: auto;font-family: 'Nunito Sans', sans-serif;margin: 0;padding-left: 15px;vertical-align: top;">
                <h2 style="font-family: 'Nunito Sans', sans-serif;margin: 0;font-size: 18px;font-weight: 700;color: #000;"><?php echo $pmTitle; ?></h2>
                <div class="pmrelDesc" style="display: block;margin-top: 10px;">
                    <?php echo $pmDescrition; ?>
                </div>
                <h4 style="font-family: 'Nunito Sans', sans-serif;margin: 0;border: none;text-transform: capitalize;color: #000;margin-top: 20px;font-size: 16px;font-weight: 700;">Tracklist</h4>
                <ol style="padding-left: 15px;">
                    <?php print_tracks(true); ?>
                </ol>
                <div class="pmviewfull" style="display: block;position: relative;margin-top: 15px;">
                    <a href="<?php echo $pmLink; ?>" target="_blank" style="display: inline-block;text-decoration: none;color: #fff;background-color: #10a98d;border-radius: 4px;padding: 12px 30px;font-weight: 700;text-transform: uppercase;">View this promo</a>
                </div>
            </td>
        </tr>
    </table>
</div>
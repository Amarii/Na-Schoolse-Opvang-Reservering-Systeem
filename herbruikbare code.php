
<div class="row">

            <div class="input-field col s12">
                <i class="material-icons prefix">date_range</i>
                <input name="date" id="date" type="number" value="<?= (isset($date) ? $date : ''); ?>" class="datepicker">
                <label for="date">Overblijf datum</label>
                <script>
$('.datepicker').pickadate({

                        format: 'yyyy/mm/dd',
                        selectMonths: true, // Creates a dropdown to control month
                        selectYears: 15, // Creates a dropdown of 15 years to control year
                        allowRange: true,
                        formatMultiple: '{, |, and finally, }.'
                    });
                </script>
            </div>
        </div>
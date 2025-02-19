     /** 
 * Scripts for the editor and the admin dashboard
 */
     lawFirmPro = jQuery.noConflict();
     lawFirmPro(function($) {
         $(document).on('click', '.gl-custom-admin-notice .notice-dismiss', function() {
             $.ajax({
                 url: law_firm_admin_data.ajax_url,
                 type: 'POST',
                 data: {
                     action   : 'lfp_dismiss_admin_notice',
                     nonce    : law_firm_admin_data.nonce
                 },
                 success: function(response) {
                     console.log(  response );
                     if (response.success) {
                         $('.gl-custom-admin-notice').hide();
                     }
                 }
             });
         });
     });
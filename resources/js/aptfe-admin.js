jQuery(document).ready(function($) {
    var $successMessage = $("#aptfe-notice-success");
    var $errorMessage   = $("#aptfe-notice-error");
    var hasPro          =  !!aptfeProVar.has_pro;
    
    $successMessage.on('click', function() {
        $(this).hide();
    });

    $errorMessage.on('click', function() {
        $(this).hide();
    });
    
    var aptfeAdminSettings = {
        tabsHandler: function() {
            let that     = this;
            let savedTab = localStorage.getItem('aptfe_active_tab');

            if (savedTab) {
                $('.aptfe-tab-btn').removeClass('active');
                $('.aptfe-tab-pane').removeClass('active');

                $('.aptfe-tab-btn[data-tab="' + savedTab + '"]').addClass('active');
                $('#' + savedTab).addClass('active');
            }

            // Tab click
            $('.aptfe-tab-btn').on('click', function(e) {
                e.preventDefault();
                let tab = $(this).data('tab');
                // Save tab
                localStorage.setItem('aptfe_active_tab', tab);
                $('.aptfe-tab-btn').removeClass('active');
                $(this).addClass('active');

                $('.aptfe-tab-pane').removeClass('active');
                $('#' + tab).addClass('active');

                if (tab === 'addons') {
                    that.getAddonsHandler();
                } else {
                    if (hasPro) {
                        that.getStatusLicense();
                        that.verifyLicense();
                        that.deactiveLicense();
                    }  
                }
            });
        },
        getStatusLicense: function() {
            $("#aptfe-loading-license").show();
            $( "#aptfe_activated_license" ).hide();
            $( "#aptfe_deactivated_license" ).hide();

            jQuery.get(aptfeProVar.ajaxurl, {
                action: 'aptfe_pro_lincese_ajax_actions', 
                route: 'get_license_status',
                nonce: aptfeProVar.nonce
            })
                .then(function(response) {
                    if ( response.data.license_data.status === 'valid' ) {
                        $( "#aptfe_activated_license" ).hide()
                        $( "#aptfe_deactivated_license" ).show();
                        $("#aptfe-loading-license").hide();
                    } else {
                        $( "#aptfe_activated_license" ).show()
                        $( "#aptfe_deactivated_license" ).hide();
                    }
                })
                .fail(function(error) {
                    console.log('Something is wrong! Please try again');
                })
                .always(function() {
                    $("#aptfe-loading-license").hide();
                });
        },
        verifyLicense: function() {
            $('#aptfe_verify_btn').on('click', function(e) {
				$("#aptfe-loading-license").show();
                $('#aptfe_activated_license').hide();
                $("#aptfe_deactivated_license").hide();
                e.preventDefault();
                
                jQuery.post(aptfeProVar.ajaxurl, {
                    action: 'aptfe_pro_lincese_ajax_actions',
                    route: 'activate_license', 
                    license_key: jQuery('#aptfe_license_settings_field').val(),
                    nonce: aptfeProVar.nonce
                })
                    .then(function(response) {
                        if (response.success == true) {
                            $("#aptfe-loading-license").hide();
                            $('#aptfe_activated_license').hide();
                            $("#aptfe_deactivated_license").show();
                            $successMessage.show();
                            $successMessage.find('p').html(response.data.message);
                            $(".aptfe_activate_message").hide();
                        } else {
							$("#aptfe-loading-license").hide();
							$('#aptfe_activated_license').show();
							$("#aptfe_deactivated_license").hide();
                            $errorMessage.show();
                            $errorMessage.find('p').html(response.data.message);
                        }
                    })
                    .fail(function(error) {
                        $("#aptfe-loading-license").hide();
                        $("#aptfe_activated_license").show();
                        $("#aptfe_deactivated_license").hide();
                        $errorMessage.show();
                        $errorMessage.find('p').html('Something is wrong! Please try again');
                    })
                    .always(function() {
                    });
            })
        },
        deactiveLicense: function() {
            $('#aptfe_deactive_license').on('click', function(e) {
                $("#aptfe-loading-license").show();
                $("#aptfe_deactivated_license").hide();

                e.preventDefault();
                jQuery.post(aptfeProVar.ajaxurl, {
                    action: 'aptfe_pro_lincese_ajax_actions', 
                    route: 'deactivated_license',
                    nonce: aptfeProVar.nonce
                })
                    .then(function(response) {
                        $("#aptfe-loading-license").hide();
                        $("#aptfe_activated_license").show();
                        $("#aptfe_deactivated_license").hide();
                        $successMessage.show();
                        $successMessage.find('p').html(response.data.message);
                    })
                    .fail(function(error) {
                        $errorMessage.show();
                        $errorMessage.find('p').html('Something is wrong! Please try again');
                    })
                    .always(function() {
                    });
            })
        },
        // Active Plugin 
        installHandler: function() {
            let that = this;
            $(document).on('click', '.aptfe-install-addon', function(e) {
                e.preventDefault();
                jQuery.post(aptfeProVar.ajaxurl, {
                    action: 'aptfe_pro_setup_addons',
                    route: $(this).attr('value'),
                    nonce: aptfeProVar.nonce
                })
                .then(function(response) {
                    that.getAddonsHandler();
                    $successMessage.show();
                    $successMessage.find('p').html(response.data.message);
                })
        
                .fail(function(error) {
                    $errorMessage.show();
                    $errorMessage.find('p').html('Something is wrong! Please try again');
                })
                .always(function() {
                });
            });
        },
        getAddonsHandler: function() {
            $("#aptfe-loading-addon").show();
            $(".aptfe-addons-wrap").hide();
        
            jQuery.get(aptfeProVar.ajaxurl, {
                action: 'aptfe_pro_setup_addons',
                route: 'get_addons',
                nonce: aptfeProVar.nonce
            })
            .then(function(response) {
                setTimeout(function() {
                    $("#aptfe-loading-addon").hide();
                    $(".aptfe-addons-wrap").show();
                }, 500);

                let getAddons = response.data.get_addons;
                let html = '';
                Object.values(getAddons).forEach(addon => {
                    html += `
                        <div class="aptfe-addons-templates">
                            <div class="addons-box">
                                <div class="image">
                                    <img src="${addon.logo}" alt="">
                                </div>
                                <h2>${addon.title}</h2>
                                <p>${addon.description ?? ''}</p>
                                <div class="btn-box">
                                    ${
                                        !addon.is_installed
                                        ? `
                                            <a class="btn aptfe-install-addon" value="${addon.route}">
                                                ${addon.action_text}
                                            </a>
                                        `
                                        : `
                                            <a href="${addon.settings_url}" class="viewInstall" target="_blank">
                                                View Settings
                                            </a>
                                        `
                                    }
                                    <a href="${addon.upgrade_to_pro_link}" class="upgrade-to-pro" target="_blank">
                                        Upgrade to Pro
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                });
            
                $(".aptfe-addons-wrap").html(html);
            })
            .fail(function(error) {
                $errorMessage.show();
                $errorMessage.find('p').html('Something is wrong! Please try again');
            })
            .always(function() {
            });
        },
        init: function(){
            this.tabsHandler();
            this.installHandler();
            this.getAddonsHandler();
            if (hasPro) {
                this.getStatusLicense();
                this.verifyLicense();
                this.deactiveLicense();
            }
        }
    } 
    aptfeAdminSettings.init();
});
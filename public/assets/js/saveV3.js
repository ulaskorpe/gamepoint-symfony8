async function save(formData,route,formID,btn,reload) {
    // Show loading state
    if(btn!='') {
        $('#'+btn).prop('disabled', true);
        // Try different possible text/loading ID patterns
        var textId = '';
        var loadingId = '';
        
        // Pattern 1: submit_button_message_admin -> submit_text_message_admin
        if (btn.includes('submit_button_')) {
            textId = '#' + btn.replace('submit_button_', 'submit_text_');
            loadingId = '#' + btn.replace('submit_button_', 'submit_loading_');
        } 
        // Pattern 2: submit_button -> submit_text
        else if (btn.includes('submit_button')) {
            textId = '#' + btn.replace('submit_button', 'submit_text');
            loadingId = '#' + btn.replace('submit_button', 'submit_loading');
        }
        
        // Check if custom IDs exist, otherwise use default pattern
        if (textId && $(textId).length > 0) {
            $(textId).hide();
        } else if ($('#'+btn+' #submit_text').length > 0) {
            $('#'+btn+' #submit_text').hide();
        }
        
        if (loadingId && $(loadingId).length > 0) {
            $(loadingId).show();
        } else if ($('#'+btn+' #submit_loading').length > 0) {
            $('#'+btn+' #submit_loading').show();
        }
    }
 
    return $.ajax({
        url:  route,
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        success: function (data) {
            //console.log(data.status);
            if(data.status=='error'){
                Swal.fire({
                    title: 'Hata!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'Tamamdır'
                }).then(() => {
                    // Swal kapandıktan sonra butonu aktif et
                    if(btn!='') {
                        resetButtonState(btn);
                    }
                });
            }else{
                Swal.fire({
                    title: 'Tebrikler',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Tamamdır'
                }).then(() => {
                    // Swal kapandıktan sonra butonu aktif et ve formu resetle
                    if(btn!='') {
                        resetButtonState(btn);
                    }
                    // Form resetleme (mesaj formları için)
                    if(formID && (formID.includes('message_form') || formID === 'message_form_admin' || formID === 'message_form_user')) {
                        resetMessageForm(formID);
                    }
                    // Contact formu için özel reset
                    if(formID && formID === 'contact-form') {
                        var contactForm = document.getElementById(formID);
                        if(contactForm) {
                            contactForm.reset();
                        }
                    }
                    // Comment formu için özel reset
                    if(formID && formID === 'comment-form') {
                        var commentForm = document.getElementById(formID);
                        if(commentForm) {
                            // Post ID'yi sakla (form resetlenmeden önce)
                            var postId = $('#post_id').val();
                            commentForm.reset();
                            // Post ID'yi tekrar ayarla (form resetlendikten sonra)
                            if(postId) {
                                $('#post_id').val(postId);
                            }
                            // Parent ID'yi ve seçili yorumu temizle
                            $('#parent_id').val('');
                            $('#selected-comment-preview').hide();
                            $('#selected-comment-content').html('');
                            // Yorumlar sekmesine geç
                            if($('#comments-tab').length > 0) {
                                $('#comments-tab').tab('show');
                            }
                            // Blog comments bölümünü yeniden yükle (ilk sayfaya dön)
                            var blogId = $('#blog_comments').data('blog-id') || postId;
                            if(blogId) {
                                var commentsUrl = '/blog-comments/' + blogId;
                                $.ajax({
                                    url: commentsUrl,
                                    type: 'GET',
                                    success: function(response) {
                                        $('#blog_comments').html(response);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Yorumlar yüklenirken hata oluştu:', error);
                                    }
                                });
                            }
                        }
                    }
                });
                
            }
           
            console.log(reload);
            
            if(reload){
                if(reload === 'reload') {
                    // Sadece sayfayı yenile
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else if(reload.startsWith('redirect:')) {
                    // redirect: prefix'i ile başlıyorsa, prefix'i kaldır ve yönlendir
                    const redirectUrl = reload.replace('redirect:', '');
                    setTimeout(function() {
                        window.location.href = redirectUrl;
                    }, 1000);
                } else {
                    // Belirtilen URL'ye yönlendir
                    setTimeout(function() {
                        window.location.href = reload;
                    }, 1000);
                }
            }
        
        },
        error: function (data) {
            var errorMessage = 'Bir hata oluştu.';

            if (data.status === 422) {
                var errors = data.responseJSON.errors;
                var message = "";
                $.each(errors, function (key, value) {
                    message += key + ' : ' + value;
                });
                errorMessage = message || 'Form doğrulama hatası';
            } else if (data.status === 500) {
                errorMessage = 'Sunucu hatası oluştu. Lütfen tekrar deneyin.';
            }

            Swal.fire({
                title: 'Hata!',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'Tamamdır'
            }).then(() => {
                // Swal kapandıktan sonra butonu aktif et
                if(btn!='') {
                    resetButtonState(btn);
                }
            });
        },
        complete: function() {
            // Error durumunda buton zaten aktif edildi, success durumunda Swal kapandıktan sonra aktif edilecek
            // Burada sadece error durumunda veya Swal gösterilmeyen durumlarda aktif et
            // (success durumunda Swal.then() içinde aktif ediliyor)
        }
    });
}

// Buton durumunu sıfırla
function resetButtonState(btn) {
    $('#'+btn).prop('disabled', false);
    var textId = '';
    var loadingId = '';
    
    // Pattern 1: submit_button_message_admin -> submit_text_message_admin
    if (btn.includes('submit_button_')) {
        textId = '#' + btn.replace('submit_button_', 'submit_text_');
        loadingId = '#' + btn.replace('submit_button_', 'submit_loading_');
    } 
    // Pattern 2: submit_button -> submit_text
    else if (btn.includes('submit_button')) {
        textId = '#' + btn.replace('submit_button', 'submit_text');
        loadingId = '#' + btn.replace('submit_button', 'submit_loading');
    }
    
    if (textId && $(textId).length > 0) {
        $(textId).show();
    } else if ($('#'+btn+' #submit_text').length > 0) {
        $('#'+btn+' #submit_text').show();
    }
    
    if (loadingId && $(loadingId).length > 0) {
        $(loadingId).hide();
    } else if ($('#'+btn+' #submit_loading').length > 0) {
        $('#'+btn+' #submit_loading').hide();
    }
}

// Mesaj formunu sıfırla
function resetMessageForm(formID) {
    var form = document.getElementById(formID);
    if (form) {
        form.reset();
        // Checkbox'ı varsayılan duruma getir (admin formunda checked, user formunda unchecked)
        if (formID === 'message_form_admin') {
            $('#system_message_admin').prop('checked', true);
        } else if (formID === 'message_form_user') {
            $('#system_message_user').prop('checked', false);
        }
        // Hata sınıflarını temizle
        $(form).find('.border-danger').removeClass('border-danger');
    }
}
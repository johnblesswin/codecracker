!function(t){"use strict";var i=function(){this.$body=t("body"),this.$chatInput=t(".chat-input"),this.$chatList=t(".conversation-list"),this.$chatSendBtn=t(".chat-send .btn")};i.prototype.save=function(){var i=this.$chatInput.val(),s=moment().format("h:mm");""==i?(sweetAlert("Oops...","You forgot to enter your chat message","error"),this.$chatInput.focus()):(t('<li class="clearfix"><div class="chat-avatar"><img src="assets/images/users/avatar-1.jpg" alt="male"><i>'+s+'</i></div><div class="conversation-text"><div class="ctext-wrap"><i>John Deo</i><p>'+i+"</p></div></div></li>").appendTo(".conversation-list"),this.$chatInput.val(""),this.$chatInput.focus(),this.$chatList.scrollTo("100%","100%",{easing:"swing"}))},i.prototype.init=function(){var t=this;t.$chatInput.keypress(function(i){var s=i.which;return 13==s?(t.save(),!1):void 0}),t.$chatSendBtn.click(function(i){return t.save(),!1})},t.ChatApp=new i,t.ChatApp.Constructor=i}(window.jQuery),function(t){"use strict";t.ChatApp.init()}(window.jQuery);
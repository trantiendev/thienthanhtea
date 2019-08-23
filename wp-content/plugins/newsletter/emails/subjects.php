<script>
    function tnp_suggest_subject() {
        jQuery("#tnp-edit-subjects").show();
    }

    function tnp_emoji() {
        jQuery("#tnp-edit-emoji").show();
    }

    jQuery(function () {
        jQuery("#tnp-edit-subjects-list a").click(function (e) {
            e.preventDefault();
            jQuery("#options-subject").val(this.innerText);
            jQuery("#options-title").val(this.innerText);
            jQuery("#tnp-edit-subjects").hide();
        });

        jQuery("#tnp-edit-emoji-list a").click(function (e) {
            e.preventDefault();
            document.getElementById("options-subject").value = this.title + document.getElementById("options-subject").value;
            jQuery("#tnp-edit-emoji").hide();
        });

        jQuery(".tnp-popup-close").click(function () {
            $(this).parent().parent().hide();

        });
    });
</script>

<div id="tnp-edit-subjects" class="tnp-popup-overlay">
	<div class="tnp-popup">
		<a class="tnp-popup-close">&times;</a>
		<p class="tnp-subjects-header">
			Here are some subject examples you can start from to further engage your subscribers.
		</p>
		<div id="tnp-edit-subjects-list">

			<h3 class="tnp-subject-category"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" xml:space="preserve" width="18" height="18"><g class="nc-icon-wrapper"><path fill="#43A6DD" d="M10,5C9.668,5,9.358,5.165,9.172,5.439C8.986,5.714,8.948,6.063,9.071,6.371 c0.078,0.194,7.669,19.475,0.222,26.922c-0.286,0.286-0.372,0.716-0.217,1.09C9.23,34.757,9.596,35,10,35h28c0.553,0,1-0.447,1-1 C39,18.01,25.99,5,10,5z"></path> <path fill="#BADEFC" d="M46,43c0.552,0,1-0.448,1-1V30.544c-0.646,0.29-1.257,0.684-1.787,1.214c-2.343,2.343-6.142,2.343-8.485,0 c-2.343-2.343-6.142-2.343-8.485,0c-2.343,2.343-6.142,2.343-8.485,0s-6.142-2.343-8.485,0s-6.142,2.343-8.485,0 c-0.53-0.53-1.141-0.924-1.787-1.214V42c0,0.552,0.448,1,1,1H46z"></path></g></svg>Dangers</h3>
			<a href="#"><?php _e('How safe is your <em>[something]</em> from <em>[danger]</em>?', 'newsletter') ?></a><br>
			<a href="#"><?php _e('10 Warning Signs That <em>[something]</em>', 'newsletter') ?></a><br>
			<a href="#"><?php _e('10 Lies <em>[kind of people]</em> Likes to Tell', 'newsletter') ?></a><br>

			<h3 class="tnp-subject-category"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" xml:space="preserve" width="18" height="18"><g class="nc-icon-wrapper"><path fill="#7C5839" d="M38.75586,31.34473C38.56543,31.12598,38.29004,31,38,31H10c-0.29004,0-0.56543,0.12598-0.75586,0.34473 c-0.18945,0.21924-0.27539,0.50977-0.23438,0.79688l2,14C11.08008,46.63428,11.50195,47,12,47h24 c0.49805,0,0.91992-0.36572,0.99023-0.8584l2-14C39.03125,31.85449,38.94531,31.56396,38.75586,31.34473z"></path> <path fill="#72C472" d="M34,6c-3.96655,0-7.38348,2.31537-9,5.66302V2c0-0.55225-0.44727-1-1-1s-1,0.44775-1,1v26 c0,0.55225,0.44727,1,1,1s1-0.44775,1-1v-8h1c5.52283,0,10-4.47717,10-10V6H34z"></path> <path fill="#A67C52" d="M42,33H6c-0.55273,0-1-0.44775-1-1v-4c0-0.55225,0.44727-1,1-1h36c0.55273,0,1,0.44775,1,1v4 C43,32.55225,42.55273,33,42,33z"></path></g></svg>Better life, problem management</h3>
			<a href="#"><?php _e('10 Ways to Simplify Your <em>[something]</em>', 'newsletter') ?></a><br>
			<a href="#"><?php _e('Get Rid of <em>[problem]</em> Once and Forever', 'newsletter') ?></a><br>
			<a href="#"><?php _e('How to End [problem]', 'newsletter') ?></a><br>
			<a href="#"><?php _e('Secrets of [famous people]', 'newsletter') ?></a><br>

			<h3 class="tnp-subject-category"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" xml:space="preserve" width="18" height="18"><g class="nc-icon-wrapper"><path fill="#444444" d="M8,27H2c-0.553,0-1-0.447-1-1s0.447-1,1-1h6c0.553,0,1,0.447,1,1S8.553,27,8,27z"></path> <path fill="#444444" d="M12.185,15.19c-0.256,0-0.513-0.098-0.708-0.293l-4.185-4.19c-0.39-0.392-0.39-1.024,0.001-1.415 c0.391-0.389,1.024-0.39,1.415,0.001l4.185,4.19c0.39,0.392,0.39,1.024-0.001,1.415C12.696,15.093,12.44,15.19,12.185,15.19z"></path> <path fill="#444444" d="M35.815,15.19c-0.256,0-0.512-0.098-0.707-0.292c-0.391-0.391-0.391-1.023-0.001-1.415l4.185-4.19 c0.391-0.391,1.024-0.39,1.415-0.001c0.391,0.391,0.391,1.023,0.001,1.415l-4.185,4.19C36.328,15.093,36.071,15.19,35.815,15.19z"></path> <path fill="#444444" d="M8,45c-0.256,0-0.513-0.098-0.708-0.293c-0.39-0.392-0.39-1.024,0.001-1.415l4.189-4.184 c0.391-0.389,1.024-0.39,1.415,0.001c0.39,0.392,0.39,1.024-0.001,1.415l-4.189,4.184C8.512,44.902,8.256,45,8,45z"></path> <path fill="#444444" d="M40,45c-0.256,0-0.512-0.098-0.707-0.292l-4.189-4.184c-0.391-0.391-0.391-1.023-0.001-1.415 c0.391-0.391,1.024-0.39,1.415-0.001l4.189,4.184c0.391,0.391,0.391,1.023,0.001,1.415C40.513,44.902,40.256,45,40,45z"></path> <path fill="#444444" d="M46,27h-6c-0.553,0-1-0.447-1-1s0.447-1,1-1h6c0.553,0,1,0.447,1,1S46.553,27,46,27z"></path> <path fill="#E86C60" d="M32.324,9.555c-0.164-0.108-0.355-0.166-0.552-0.166c-0.001,0-0.001,0-0.002,0L16.188,9.413 c-0.196,0-0.389,0.059-0.552,0.167C10.31,13.125,7,19.799,7,27c0,11.028,7.626,20,17,20s17-8.972,17-20 C41,19.777,37.676,13.093,32.324,9.555z"></path> <path fill="#444444" d="M34.707,1.293c-0.391-0.391-1.023-0.391-1.414,0l-3.694,3.694C28.051,3.744,26.1,3,24,3 s-4.051,0.744-5.599,1.987l-3.694-3.694c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l3.689,3.689 c-0.993,1.243-1.669,2.757-1.891,4.426c-0.021,0.156-0.004,0.316,0.049,0.466C15.425,12.096,20.198,15,24,15s8.575-2.904,8.86-3.712 c0.053-0.149,0.069-0.31,0.049-0.466c-0.223-1.669-0.898-3.183-1.891-4.426l3.689-3.689C35.098,2.316,35.098,1.684,34.707,1.293z"></path> <path fill="#444444" d="M24,47c0.338,0,0.667-0.037,1-0.06V14c0-0.553-0.447-1-1-1s-1,0.447-1,1v32.94 C23.333,46.963,23.662,47,24,47z"></path> <circle fill="#444444" cx="15" cy="23" r="3"></circle> <circle fill="#444444" cx="17.5" cy="34.5" r="2.5"></circle> <circle fill="#444444" cx="33" cy="23" r="3"></circle> <circle fill="#444444" cx="30.5" cy="34.5" r="2.5"></circle></g></svg>Mistakes</h3>
			<a href="#"><?php _e('Do You Make These 10 <em>[something]</em> Mistakes?', 'newsletter') ?></a><br>
			<a href="#"><?php _e('10 <em>[something]</em> Mistakes That Make You Look Dumb', 'newsletter') ?></a><br>
			<a href="#"><?php _e('Don\'t do These 10 Things When <em>[something]</em>', 'newsletter') ?></a><br>

			<h3 class="tnp-subject-category"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" xml:space="preserve" width="18" height="18"><g class="nc-icon-wrapper"><path fill="#5A7A84" d="M6,13c2.75684,0,5-2.24316,5-5S8.75684,3,6,3S1,5.24316,1,8S3.24316,13,6,13z"></path> <path fill="#5A7A84" d="M6,19c-2.75684,0-5,2.24316-5,5s2.24316,5,5,5s5-2.24316,5-5S8.75684,19,6,19z"></path> <path fill="#5A7A84" d="M6,35c-2.75684,0-5,2.24316-5,5s2.24316,5,5,5s5-2.24316,5-5S8.75684,35,6,35z"></path> <path fill="#76B5B5" d="M46,10H16c-0.55229,0-1-0.44771-1-1V7c0-0.55228,0.44771-1,1-1h30c0.55228,0,1,0.44772,1,1v2 C47,9.55229,46.55228,10,46,10z"></path> <path fill="#76B5B5" d="M34,26H16c-0.55229,0-1-0.44772-1-1v-2c0-0.55228,0.44771-1,1-1h18c0.55228,0,1,0.44772,1,1v2 C35,25.55228,34.55228,26,34,26z"></path> <path fill="#76B5B5" d="M46,42H16c-0.55229,0-1-0.44772-1-1v-2c0-0.55228,0.44771-1,1-1h30c0.55228,0,1,0.44772,1,1v2 C47,41.55228,46.55228,42,46,42z"></path></g></svg>Lists (classic)</h3>
			<a href="#"><?php _e('10 Ways to <em>[something]</em>', 'newsletter') ?></a><br>
			<a href="#"><?php _e('The Top 10 <em>[something]</em>', 'newsletter') ?></a><br>
			<a href="#"><?php _e('The 10 Rules for <em>[something]</em>', 'newsletter') ?></a><br>
			<a href="#"><?php _e('Get/Become <em>[something]</em>. 10 Ideas That Work', 'newsletter') ?></a><br>

		</div>
	</div>
</div>

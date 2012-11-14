=== Captcha ===
Contributors: bestwebsoft
Donate link: http://bestwebsoft.com/
Tags: captcha, math captcha, text captcha, spam, antispam, login, registration, comment, lost password, capcha, catcha, captha
Requires at least: 2.9
Tested up to: 3.3
Stable tag: 2.17

This plugin allows you to implement super security captcha form into web forms.

== Description ==

Captcha plugin allows you to protect your website from spam using math logic which can be used for login, registration, reseting password, comments forms. Added Russian, German and Dutch languages.

<a href="http://wordpress.org/extend/plugins/captcha/faq/" target="_blank">FAQ</a>
<a href="http://bestwebsoft.com/plugin/captcha-plugin/" target="_blank">Support</a>

= Features =

* Display: it is possible to use letters and numbers in the captcha or just one of these two things - either letters or numbers.
* Actions: The basic mathematical operations are used - add,subtract, multiply.
* Label: There is a possibility to add the label when display captcha on the form.

= Translate =

* Brazilian Portuguese (pt_BR) (thanks <a href="mailto:brenojac@gmail.com">Breno Jacinto, www.iconis.org.br)
* Danish (dk_DK) (thanks Byrial Ole Jensed)
* Dutch (nl_NL) (thanks <a href="mailto:byrial@vip.cybercity.dk">Bart Duineveld</a>)
* French (fr_FR) (thanks Martel Benjamin)
* German (de_DE) (thanks Thomas Hartung)
* Polish (pl_PL) (thanks Krzysztof Opuchlik)
* Russian (ru_RU)
* Spain (es_ES) (thanks Iván García Cubero)

If you create your own language pack or update the existing one, you can send <a href="http://codex.wordpress.org/Translating_WordPress" target="_blank">the text of PO and MO files</a> for <a href="http://bestwebsoft.com/" target="_blank">BWS</a> and we'll add it to the plugin. You can download the latest version of the program for work with PO and MO files  <a href="http://www.poedit.net/download.php" target="_blank">Poedit</a>.

== Installation ==

1. Upload `captcha` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Site wide Settings are located in "Settings", "Captcha".

== Frequently Asked Questions ==

= How to change captcha label =

Go to the Settings page and change value for the 'Label for CAPTCHA in form' field.

= During saving of settings I got an error: 'Please select one point in the blocks Arithmetic actions and Difficulty for CAPTCHA'. What is this? =

For correct work of Captcha plugin you need to choose at least one item from the 'Arithmetic actions' block and choose 'Difficulty' via Settings page, because math expression should be consisted minimum with 1 mathematical sign, and parts of mathematical expression should be displayed like words or like numbers, or both of them.

= Missing CAPTCHA on comment form? = 

You may have a theme that has a not properly coded comments.php. 

The version of WP makes a difference...

(WP2 series) Your theme must have a `<?php do_action('comment_form', $post->ID); ?>` tag inside your `/wp-content/themes/[your_theme]/comments.php` file. 
Most WP2 themes already do. The best place to locate the tag is before the comment textarea, you may want to move it up if it is below the comment textarea.

(WP3 series) Since WP3 there is new function comment_form inside `/wp-includes/comment-template.php`. 
Your is theme probably not up to current code to call that function from inside comments.php.
WP3 theme does not need the `do_action('comment_form'`... code line inside `/wp-content/themes/[your_theme]/comments.php`.
Instead, it uses a new function call inside comments.php: `<?php comment_form(); ?>`
If you have WP3 and still have the missing captcha, make sure your theme has `<?php comment_form(); ?>`
inside `/wp-content/themes/[your_theme]/comments.php`. (look inside the Twenty Ten theme's comments.php for proper example)

= How to use the other language files with the CAPTCHA? = 

Here is an example for German language files.

1. In order to use another language for WordPress it is necessary to set the WP version on the required language and in the configurational wp file - `wp-config.php` in the line `define('WPLANG', '');` write `define('WPLANG', 'de_DE');`. If everything is done properly the admin panel will be in German.

2. Make sure that there are files `de_DE.po` and `de_DE.mo` in the plugin (the folder languages in the root of the plugin).

3. If there are no these files it will be necessary to copy other files from this folder (for example, for Russian or Italian language) and rename them (you should write `de_DE` instead of `ru_RU` in the both files).

4. The files are edited with the help of the program Poedit - http://www.poedit.net/download.php - please load this program, install it, open the file with the help of this program (the required language file) and for each line in English you should write the translation in German.

5. If everything is done properly all lines will be in German in the admin panel and on frontend.

= I would like to add Captcha to custom form on my website. How can I do this? =

1. Install the plugin Captcha, activate it.
2. Open file with the form (where is necessary to implement captcha).
3. Find the place where it is necessary to insert code to display captcha.
4. Insert lines to display captcha

`if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom() } ;`

If the form is html it will necessary to insert the line with tags php

`<?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?>`

5. It is necessary to add the lines in the function of check of the entered data (where it is checked what the user enters and if everything is correct the mail will be sent) 

`if( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) echo "Please complete the CAPTCHA."`
or
`<?php if( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) echo "Please complete the CAPTCHA." ?>`
It is possible instead of `echo "Please complete the CAPTCHA."` enter this line in variable and  display this variable in required place. If there is variable (which is answered for the displaying of the errors) in the function of check so this phrase can be added to this variable. If the function returned true so you have entered captcha properly. In other cases the function will return false.

== Screenshots ==

1. Captcha Settings page.
2. Comments form with Captcha.
3. Registration form with Captcha.
4. Lost password form with Captcha.
5. Login form with Captcha.

== Changelog ==

= V2.17 - 12.01.2012 =
* NEW : Added Spain language files for plugin.

= V2.16 - 11.01.2012 =
* NEW : Added Polish language files for plugin.

= V2.15 - 05.01.2012 =
* NEW : Added Brazilian Portuguese and French language files for plugin.

= V2.14 - 04.01.2012 =
* NEW : Added German language files for plugin.

= V2.13 - 03.01.2012 =
* Bugfix : The impossible math bug was fixed.

= V2.12 - 29.12.2011 =
* Changed : BWS plugins section. 
* Bugfix : The displaying of numerals was fixed in the Dutch language

= V2.11 - 27.12.2011 =
* NEW : Added Danish language files for plugin. 
* Changed : Added all words in language file. 

= V2.10 - 07.12.2011 =
* Bugfix : The bug of the captcha label section is fixed in this version. 

= V2.09 - 07.12.2011 =
* Changed : +, -, * changed to HTML Entity.

= V2.08 - 01.11.2011 =
* NEW : Added Dutch language files for plugin.

= V2.07 - 31.10.2011 =
* NEW : Added language files for plugin.

= V2.06 - 22.08.2011 =
* Changed : BWS Plugins sections was fixed and right now it is consisted with 3 parts: activated, installed and recommended plugins. 
* Bugfix : The bug of position in the admin menu is fixed. 

= V2.05 =
* Changed : BWS Plugins sections was fixed and right now it is consisted with 2 parts: installed and recommended plugins. 
* Bugfix : Icons displaying is fixed. 
* Bugfix : Misalignment of math transaction is fixed.

= V2.04 =
* In this version of plugin a bug of CAPTCHa reflection (before and after the comment form) was fixed. Please upgrade Captcha plugin immediately. Thank you. For more details information please see the FAQ

= V2.03 =
* In this version of plugin a bug of CAPTCHa reflection was fixed in some of the themes for release of WordPress 3.0 and above. Please upgrade Captcha plugin immediately. Thank you

= V2.02 =
* The bug of the captcha setting page link is fixed in this version. Please upgrade the Captcha plugin immediately. Thank you

= V2.01 =
* Usability at the settings page of plugin was improved.

= V1.04 =
* The bug of the captcha output is fixed in this version. Please upgrade the Captcha plugin immediately. Thank you.

= V1.03 =
* Ability to add BestWebSoft Contact Form plugin into a Captcha plugin from wp-admin via Settings panel.

= V1.02 =
* Added "Settings", "FAQ", "Support" links to the plugin action page.
* Added links on the plugins page.

= V1.01 =
* Mathematical actions choosing functionality and level of difficulty was implemented.

== Upgrade Notice ==

= V2.17 =
Added Spain language files for plugin.

= V2.16=
Added Polish language files for plugin.

= V2.15 =
Added Brazilian Portuguese and French language files for plugin.

= V2.14 =
Added German language files for plugin.

= V2.13 =
The impossible math bug was fixed. Please upgrade the Captcha plugin immediately. Thank you

= V2.12 =
BWS plugins section as fixed. The displaying of numerals was fixed in the Dutch language. Please upgrade the Captcha plugin. Thank you

= V2.11 =
Added Danish language files for plugin. Added all words in language file. Please upgrade the Captcha plugin immediately. Thank you

= V2.10 =
The bug of the captcha label section is fixed in this version. Please upgrade the Captcha plugin immediately. Thank you

= V2.09 =
+, -, * changed to HTML Entity.

= V2.08 =
Added Dutch language files for plugin.

= V2.07 =
Added language files for plugin.

= V2.06 =
BWS Plugins sections was fixed and right now it is consisted with 3 parts: activated, installed and recommended plugins.  The bug of position in the admin menu is fixed.

= V2.05 =
BWS Plugins sections was fixed and right now it is consisted with 2 parts: installed and recommended plugins. Icons displaying is fixed. Misalignment of math transaction is fixed.

= V2.04 =
In this version of plugin a bug of CAPTCHa reflection (before and after the comment form) was fixed. Please upgrade Captcha plugin immediately. Thank you. For more details information please see the FAQ

= V2.03 =
In this version of plugin a bug of CAPTCHa reflection was fixed in some of the themes for release of WordPress 3.0 and above. Please upgrade Captcha plugin immediately. Thank you

= V2.02 =
The bug of the captcha setting page link is fixed in this version. Please upgrade the Captcha plugin immediately. Thank you

= V2.01 =
Usability at the settings page of plugin was improved.

= V1.04 =
The bug of the captcha output is fixed in this version. Please upgrade the Captcha plugin immediately. Thank you

= V1.03 =
Ability to add BestWebSoft Contact Form plugin into a Captcha plugin from wp-admin via Settings panel.

= V1.02 =
Added "Settings", "FAQ", "Support" links to the plugin action page. Added links on the plugins page.

= V1.01 =
Mathematical actions choosing functionality and level of difficulty was implemented.
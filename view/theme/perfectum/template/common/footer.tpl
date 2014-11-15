
<!-- BEGIN footer.tpl -->
</div>
</div> <!-- end class container -->

<div class="footer-wrapper">
    <div class="footer clearfix">
        <div class="company">
            <span class="logo"></span>
            <div class="company-info">
                <span class="name"><a href="<?php echo $url_tom; ?>">Tom Kabinet</a></span>
                <ul id="footer-menu">
                    <li><a href="<?php echo $url_information; ?>">Informatie</a></li>
                    <li><a href="<?php echo $url_news; ?>">Nieuws</a></li>
                    <li><a href="<?php echo $url_press; ?>">Pers</a></li>
                </ul>
                <ul id="footer-submenu">
                    <li><a href="<?php echo $url_legal; ?>">Juridisch</a></li>
                    <li><a href="<?php echo $url_rights; ?>">Rechthebbenden</a></li>
                    <li><a href="<?php echo $url_cookies; ?>">Cookies</a></li>
                </ul>
            </div>
        </div>
        <div class="shares">
            <div class="fb-like" data-href="https://www.facebook.com/TomKabinet.Ebooks?ref=hl" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="https://www.tomkabinet.nl/" data-text="Tom Kabinet" data-via="TomKabinet" data-lang="nl">Tweeten</a>
            <script>!function (d, s, id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs')
                ;</script>
        </div>
        <div class="icons">
            <a href="#ideal" id="ideal"></a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#burger').on('touchstart', function () {
            if ($('.hideonmobile').css('display') == 'none') {
                $('.hideonmobile').slideDown();
            } else {
                $('.hideonmobile').slideUp();
            }
        });
    });
</script>

<div id="fb-root"></div>
<script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&appId=426176367513932&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

<script>
        (function (i, s, o, g, r, a, m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)}, i[r].l = 1 * new Date()
        ; a = s.createElement(o),
                m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga'); 
        ga('create', 'UA-52125092-1', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
</script>

</body>
</html>

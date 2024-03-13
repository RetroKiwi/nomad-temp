<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NomadTribe
 */

?>

<footer class="width-100 bg-red m-t-section-small p-x-page p-y-section">
    <div class="flex-row width-100 flex-align-start flex-center">
        <div class="image-cover" style="width: 12rem">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/media/images/logoplaceholder.png" alt="">
        </div>
        <div class="flex-col" style="margin: 0 3rem 2rem 3rem; gap: 1rem">
            <h4 class="text-black">Follow us</h4>
            <div class="flex-row height-fit" style="gap: 1rem;">
                <a href="" class="content">
                    <button class="secondary-inverse size-huge circle-icon">
                        <i class="fa-brands fa-instagram"></i>
                    </button>
                </a>
                <a href="" class="content">
                    <button class="secondary-inverse size-huge circle-icon">
                        <i class="fa-brands fa-facebook"></i>
                    </button>
                </a>
                <a href="" class="content">
                    <button class="secondary-inverse size-huge circle-icon">
                        <i class="fa-brands fa-tiktok"></i>
                    </button>
                </a>
            </div>
        </div>
        <div class="flex-col" style="margin: 0 3rem 2rem 3rem; gap: 1rem">
            <h4 class="text-black">Contact us</h4>
            <div class="flex-col height-fit" style="gap: 1rem">
                <a href="mailto:info@nomadtribecroatia.com" class="contents">
                    <p class="uppercase text-dense-lines text-white m-none">info@nomadtribecroatia.com</p>
                </a>
                <a href="tel:+385-98-765-43-21" class="contents">
                    <p class="uppercase text-dense-lines text-white m-none">+385 98 765 43 21</p>
                </a>
            </div>
        </div>
        <div class="flex-col" style="margin: 0 3rem 2rem 3rem; gap: 1rem">
            <h4 class="text-black">Sign-up</h4>
            <div class="flex-col height-fit" style="gap: 1rem">
                <label for="footerEmailInput" class="uppercase text-dense-lines text-white m-none">Enter your email for exclusive content</label>
                <input class="primary-inverse" type="email" name="" id="footerEmailInput" _value="asd@asd.com" placeholder="your email"/>
            </div>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>

</body>
</html>

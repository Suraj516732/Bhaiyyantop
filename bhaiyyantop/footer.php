<?php
/**
 * The template for displaying the footer
 *
 * @package Bhaiyyantop
 */

?>
    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-widget">
                    <h4>हमारे बारे में</h4>
                    <p>भैय्यान्टॉप भारत का एक अग्रणी न्यूज़ पोर्टल है जो नवीनतम समाचार, राजनीति, खेल, मनोरंजन और तकनीकी जगत की ख़बरें हिंदी में प्रदान करता है।</p>
                </div>
                <div class="footer-widget">
                    <h4>मुख्य श्रेणियां</h4>
                    <ul>
                        <li><a href="#">देश-विदेश</a></li>
                        <li><a href="#">बिज़नेस समाचार</a></li>
                        <li><a href="#">मनोरंजन व सिनेमा</a></li>
                        <li><a href="#">खेल और खिलाड़ी</a></li>
                        <li><a href="#">स्वास्थ्य और जीवनशैली</a></li>
                    </ul>
                </div>
                <div class="footer-widget">
                    <h4>सहायक लिंक्स</h4>
                    <ul>
                        <li><a href="#">गोपनीयता नीति</a></li>
                        <li><a href="#">नियम एवं शर्तें</a></li>
                        <li><a href="#">विज्ञापन नीतियां</a></li>
                        <li><a href="#">हमसे संपर्क करें</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <strong>भैय्यान्टॉप</strong>. सभी अधिकार सुरक्षित।</p>
                <div class="footer-socials">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>

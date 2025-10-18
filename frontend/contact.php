<!-- starter banner/ breadcrumb start -->
<div class="breadcrumb-header" style="  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('../img/contact/2.png'); background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 content">
                <h2 data-aos="slide-down" data-aos-duration="2000"><span style="color: #ff9900">Contact</span> Us Now</h2>
                <h5 class="text-center breadcrumb-intro" data-aos="slide-up" data-aos-duration="1000">Make An Inquiry Via The Form Below</h5>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="index.php">Home</a></li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- starter banner/ breadcrumb end -->

<!-- contact form start -->
 <section class="contact-section">
    <div class="container">
        <div class="row g-0 contact-row">
            <!-- Form Column -->
            <div class="col-md-6 contact-form-column">
                <form action="../backend/contact-form.php" method="post" class="contact-form">
                    <input type="text" id="fname" name="firstname" placeholder="Your first name.." class="contact-input"/required>

                    <input type="text" id="lname" name="lastname" placeholder="Your last name.." class="contact-input">

                    <input type="email" id="email" name="email" placeholder="Your email" class="contact-input" /required>

                    <label for="inquery" class="contact-label">Select A Topic Below</label>
                    <select id="inquery" name="inquery" class="contact-select">
                        <option value="web-design">Web design and development</option>
                        <option value="app-dev">App development</option>
                        <option value="graphics">Graphics design</option>
                        <option value="seo">SEO & Ads</option>
                        <option value="banners">Road side banner Ads</option>
                        <option value="branding">Branding</option>
                    </select>

                    <textarea id="subject" name="subject" placeholder="Type here your inquiry details.." class="contact-textarea" /required></textarea>

                    <button type="submit" name="submit" value="1" class="contact-submit-btn">Submit</button>
                </form>
            </div>
            
            <!-- Contact Info Column -->
            <div class="col-md-6 contact-info-column">
                <h2 class="contact-info-header">Contacts</h2>
                <div class="contact-info-content">
                    <div class="contact-info-item">
                        <i class="bi bi-geo-alt contact-info-icon"></i>
                        <span class="contact-info-text">Kampala, Uganda</span>
                    </div>
                    <div class="contact-info-item">
                        <i class="bi bi-envelope contact-info-icon"></i>
                        <a href="mailto:info@heds.com" class="contact-info-link">info@heds.com</a>
                    </div>
                    <div class="contact-info-item">
                        <i class="bi bi-whatsapp contact-info-icon"></i>
                        <a href="https://wa.me/256767819240" class="contact-info-link">(+256) 767819240</a>
                    </div>
                    <div class="contact-info-item">
                        <i class="bi bi-phone contact-info-icon"></i>
                        <a href="tel:(+256) 703618938" class="contact-info-link">(+256) 703618938</a>
                    </div>
                    <div class="contact-info-item">
                        <i class="bi bi-phone contact-info-icon"></i>
                        <a href="tel:(+256) 704877732" class="contact-info-link">(+256) 704877732</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact form end -->

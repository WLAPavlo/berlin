<?php
/**
 * Template Name: Accessibility
 */
get_header(); ?>

    <main class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <article class="entry">
                        <div class="entry__content">
                            <p>Berlin First Baptist Church is committed to ensuring digital accessibility for people with disabilities. We are continually improving the user experience for everyone and applying the relevant accessibility standards.</p>

                            <h2>Measures to Support Accessibility</h2>
                            <p>Berlin First Baptist Church takes the following measures to ensure accessibility:</p>
                            <ul>
                                <li>Include accessibility as part of our mission statement</li>
                                <li>Include accessibility throughout our internal policies</li>
                                <li>Integrate accessibility into our procurement practices</li>
                                <li>Provide continual accessibility training for our staff</li>
                                <li>Assign clear accessibility goals and responsibilities</li>
                                <li>Employ formal accessibility quality assurance methods</li>
                            </ul>

                            <h2>Conformance Status</h2>
                            <p>The Web Content Accessibility Guidelines (WCAG) defines requirements for designers and developers to improve accessibility for people with disabilities. It defines three levels of conformance: Level A, Level AA, and Level AAA. This website is partially conformant with WCAG 2.1 level AA.</p>

                            <h2>Feedback</h2>
                            <p>We welcome your feedback on the accessibility of this website. Please let us know if you encounter accessibility barriers:</p>
                            <ul>
                                <li>Phone: <?php echo get_field('phone', 'options') ?: '(410) 641-4300'; ?></li>
                                <li>Email: <?php echo get_field('email', 'options') ?: 'info@berlinfbc.org'; ?></li>
                                <li>Visitor Address: <?php echo get_field('address', 'options') ?: '613 William St, Berlin, MD 21811'; ?></li>
                            </ul>

                            <h2>Technical Specifications</h2>
                            <p>Accessibility of this website relies on the following technologies to work with the particular combination of web browser and any assistive technologies or plugins installed on your computer:</p>
                            <ul>
                                <li>HTML</li>
                                <li>WAI-ARIA</li>
                                <li>CSS</li>
                                <li>JavaScript</li>
                            </ul>

                            <h2>Assessment Approach</h2>
                            <p>Berlin First Baptist Church assessed the accessibility of this website by the following approaches:</p>
                            <ul>
                                <li>Self-evaluation</li>
                                <li>External evaluation</li>
                            </ul>

                            <p><em>This statement was created on <?php echo date('F j, Y'); ?> using the W3C Accessibility Statement Generator Tool.</em></p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>
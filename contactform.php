<?php
/**
 * Template Name: Contact Us
 * The template for the contact page
 *
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package familyplanner
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : // 
			the_post();
            // get_template_part( 'template-parts/contact-form.php' );
            // If comments are open or we have at least one comment, load up the comment template.
        ?>
<div class="fp-contact-background">
    <section class="fp-contact-form">

        <form class="fp-form" method="post" action=".">
                
            <label class="fp-label">Name</label>
            <input class="fp-input" name="name" placeholder="Type Here">
                    
            <label class="fp-label">Email</label>
            <input class="fp-input" name="email" type="email" placeholder="Type Here">
                    
            <label class="fp-label">Message</label>
            <textarea class="fp-textarea" name="message" placeholder="Type Here"></textarea>
            
            <label class="fp-label">*What is 2+2? (Anti-spam)</label>
            <input class="fp-input" name="human" placeholder="Type Here">

            <input class="fp-input" id="submit" name="submit" type="submit" value="Submit">
                    
        </form>

    <?php
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $from = 'From: FamilyPlanner'; 
        $to = 'coreytoneil@gmail.com'; 
        $subject = 'Hello';
        $human = $_POST['human'];
        error_log(print_r($_POST,true));
        error_log(get_option('admin_email'));

        $body = "From: $name\n E-Mail: $email\n Message:\n $message";
        if ($_POST['submit'] && $human == '4') {				 
            if (mail ($to, $subject, $body, $from)) { 
                echo '<p>Your message has been sent!</p>';
            } else { 
                echo '<p>Something went wrong, go back and try again!</p>'; 
        } 
        } else if ($_POST['submit'] && $human != '4') {
            echo '<p>You answered the anti-spam question incorrectly!</p>';
        }
    ?>

    </section>
</div>
        <?php    
            if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
        
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

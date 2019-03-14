<header class="body">

</header>

<section class="fp-contact-form">

    <form class="fp-form" method="post" action="">
            
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

<footer class="body">

</footer>
<?php // help.php
  require_once 'header.php';

echo <<<_END
    <div style="font-family:'Courier New'; margin: 20px;">
      <h1 class="center pb-5">WorkSocial Help Page</h1>
      
      <h2 class="my-3">Getting Started</h2>
      <p>Welcome to WorkSocial! To start using the app, follow these steps:</p>
      <ol>
        <li><strong>Sign Up:</strong> Create an account using your email and a secure password.</li>
        <li><strong>Complete Your Profile:</strong> Add details like your name, job title, and interests.</li>
        <li><strong>Connect with Colleagues:</strong> Search for colleagues or invite others to join.</li>
      </ol>
      
      <h2>Frequently Asked Questions (FAQs)</h2>
      <p>Here are answers to some common questions:</p>
      <ul>
        <li><strong>Q: How do I reset my password?</strong></li>
        <li>A: Go to the login page and click on "Forgot Password?" to reset your password.</li>
        <li><strong>Q: Can I create a private group?</strong></li>
        <li>A: Yes, go to the Groups section and select "Create Group" to start a private group.</li>
        <li><strong>Q: Is my data secure?</strong></li>
        <li>A: Absolutely! We use advanced encryption to protect your data.</li>
      </ul>
      
      <h2>Contact Us</h2>
      <p>If you have further questions or need support, please reach out to our team:</p>
      <ul>
        <li>Email: support@worksocial.com</li>
        <li>Phone: +1-800-555-1234</li>
      </ul>
    </div>
  </body>
</html>
_END;
?>

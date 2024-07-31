<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto 120px;
        }

        h1 {
            color: #B91216;
            margin-bottom: 20px;
        }

        /* Contact Form Styles */
        .contact-form {
            margin-bottom: 40px;
        }

        .contact-form input[type="text"],.contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: none;
        }
        .contact-form textarea {
            height: 150px;
        }

        .contact-form input[type="submit"] {
            background-color: #B91216;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* FAQ Styles */
        .faq {
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .faq h2 {
            color: #B91216;
            margin-bottom: 20px;
        }

        .faq-item {
            margin-bottom: 20px;
        }

        .faq-item h3 {
            margin-bottom: 10px;
            cursor: pointer;
        }

        .faq-item p {
            display: none;
        }

        /* Search Styles */
        .search-form {
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Help Page</h1>

    <!-- Contact Form -->
    <div class="contact-form">
        <h2>Contact Admin</h2>
        <form action="#">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message"  required></textarea>
            <input type="submit" value="Send Message">
        </form>
    </div>

    <!-- Search Section -->
    <div class="search-form">
        <input type="text" id="searchInput" placeholder="Search FAQs" oninput="searchFAQs(this.value)">
    </div>

    <!-- FAQ Section -->
    <div class="faq">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-item">
            <h3 onclick="toggleAnswer(this)">What is Lorem Ipsum?</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="faq-item">
            <h3 onclick="toggleAnswer(this)">How do I contact support?</h3>
            <p>Contact support through the provided contact form.</p>
        </div>
        <!-- Add more FAQ items as needed -->
    </div>
</div>

<script>
    function toggleAnswer(element) {
        const answer = element.nextElementSibling;
        answer.style.display = answer.style.display === 'none' ? 'block' : 'none';
    }

    function searchFAQs(query) {
        const faqItems = document.querySelectorAll('.faq-item');
        query = query.toLowerCase();

        faqItems.forEach(item => {
            const question = item.querySelector('h3').innerText.toLowerCase();
            const answer = item.querySelector('p').innerText.toLowerCase();

            if (question.includes(query) || answer.includes(query)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>

<!-- Headings to fade in from either side of the page - left, right, left, right. Use CSS or JS animation framework for this. Keep text static.-->
<!-- Headings to be the same colour as their pages. -->

<div class="columns">
    <div class="column">
        <div class="center-heading heading-left budget" id="budget">
            <p> Budget </p>
        </div>
        <div class="main-paragraph">
            <p class="center-text">
                The (Stupid) <strong class="budget"> Budget </strong> helps you to visually see your budget and spending
                with
                progress bars.
            </p>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column">
        <div class="center-heading heading-right accounts" id="accounts">
            <p> Accounts </p>
        </div>
        <div class="main-paragraph">
            <p class="center-text">
                The <strong class="accounts"> Accounts </strong> page allows you to easily add access all of your
                banking or retail
                accounts on one view.
            </p>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column">
        <div class="center-heading heading-left income" id="income">
            <p> Income </p>
        </div>
        <div class="main-paragraph">
            <p class="center-text">
                The <strong class="income"> Income </strong> page lets you add an income to your account(s) as you
                receive payment.
            </p>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column">
        <div class="center-heading heading-right expenses" id="expenses">
            <p> Expenses </p>
        </div>
        <div class="main-paragraph">
            <p class="center-text">
                The <strong class="expenses"> Expenses </strong> page helps you to track your spending and allows you to
                search for
                expenses by date.
            </p>
        </div>
    </div>
</div>

<br>
<br>
<br>

<!-- Short description of what KISS is and where the name comes from-->
<div class="columns">
    <div class="column">
        <div class="media-content">
            <div class="content">

                <p class="header"> Stupid Budget </p>

                Have you ever heard of <em>Keep It Simple Stupid</em>?<br>
                Keep It Simple Stupid, or K-I-S-S, was developed and used as a design principle by the US Navy in the
                60s. Stupid Budget is digital proof that Simple is Better.<br>
                Manage your money, simply, with Stupid Budget.

            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>

<!-- Image gallery -->

<!-- images -->
<div class="columns gallery" id="galleryHeight">

    <figure class="image is-4by2 gallery-image" id="imageWidth">
        <img src="images/Budget.png" alt="Image">
    </figure>


    <figure class="image is-4by2 gallery-image">
        <img src="images/Accounts.png" alt="Image">
    </figure>

    <figure class="image is-4by2 gallery-image">
        <img src="images/Income.png" alt="Image">
    </figure>

    <figure class="image is-4by2 gallery-image">
        <img src="images/Expenses.png" alt="Image">
    </figure>

</div>

<!-- control buttons -->
<p class="field left-button" id="buttonLeft">
    <a class="button is-primary" onclick="moveLeft()">
    <span class="icon is-small">
      <i class="fa fa-angle-left"></i>
    </span>
    </a>
</p>
<p class="field right-button" id="buttonRight">
    <a class="button is-primary" onclick="moveRight()">
    <span class="icon is-small">
      <i class="fa fa-angle-right"></i>
    </span>
    </a>
</p>





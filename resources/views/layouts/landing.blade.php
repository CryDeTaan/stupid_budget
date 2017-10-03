<!-- Headings to fade in from either side of the page - left, right, left, right. Use CSS or JS animation framework for this. Keep text static.-->
<!-- Headings to be the same colour as their pages. -->
<div class="columns">
    <div class="column">
        <div class="center-heading budget" id="budget">
            <p> Stupid Budget </p>
        </div>
        <div class="main-paragraph">
            <p class="center-text">
                No one likes setting up a <strong class="budget"> Budget </strong> and never mind maintaining it. But it has to be done.
            </p>
            <br>
            <p class="center-text">
                <strong class="accounts">Budgeting is stupid.</strong>
            </p>
        <br>
            <p class="center-text">
                So lets use K.I.S.S - Let's keep it simple, stupid.
                (K-I-S-S, was developed and used as a design principle by the US Navy in the 60s)
            </p>
        </div>
    </div>
</div>

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

<!-- Image gallery -->

<!-- images -->
<div class="columns gallery" id="galleryHeight">

    <figure class="image is-4by2 gallery-image" id="imageWidth">
        <img src="images/Dashboard.png" alt="Image">
    </figure>

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





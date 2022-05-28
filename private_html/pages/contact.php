<div class="container">
    <div class="row my-3">
        <span class="fs-1 text-center text">
            Contact Form
        </span>
    </div>
    <div class="row">
        <span class="fs-4 text-center text my-3">
                Write your message and contact information below and we will be in touch as soon as we can :)
            </span>
        <form class="container" method="POST">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address (Required)</label>
                <input type="email" class="form-control" id="email" placeholder="name@domain.com" require>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone number</label>
                <input type="tel" class="form-control" id="exampleFormControlInput1" placeholder="+46 123456789">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message (Required)</label>
                <textarea class="form-control" id="message" rows="5"></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mb-3 col-12">Send message!</button>
            </div>
    </form>
    </div>
</div>
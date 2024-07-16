<div class="container text-light">
    <div class="row my-3">
        <span class="fs-1 text-center text">
            Kontakt formulär
        </span>
    </div>
    <div class="row">
        <span class="fs-4 text-center text my-3">
            Skriv ditt meddelande och kontaktuppgifter nedan så hör vi av oss så snart vi kan :)
        </span>
        <span class="fs-4 text-center text my-3">
            Dagliga beställningar görs genom knappen på meny sidan! Dem kan alltså <b>inte</b> göras härifrån!
        </span>
        <form class="container" id="mainContactForm" name="contactForm" onsubmit="event.preventDefault(); sendMessage();">
            <div class="mb-3">
                <label for="type" class="form-label">Typ av meddelande (Krävs)</label>
                <select class="form-select" aria-label="Default select example" id="type" name="type" require>
                    <option value="1">Vanlig fråga</option>
                    <option value="2">Tekniskt fel (Gäller enbart fel på knifetownburgers.se och inte beställningar genom Qopla)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Mejladress (Krävs)</label>
                <input type="email" class="form-control" id="email" placeholder="name@domain.com" require>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telefonnummer</label>
                <input type="tel" class="form-control" id="phone" placeholder="+46 123456789">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Meddelande (Krävs)</label>
                <textarea class="form-control" id="message" rows="5"></textarea>
            </div>
            <div class="col-12">
                <button id="send-contact-form" type="submit" class="btn btn-success mb-3 col-12">Skicka meddelande!</button>
            </div>
    </form>
    </div>
</div>

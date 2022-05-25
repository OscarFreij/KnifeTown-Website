function SetActivePage() {
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
      });
      let value = params.page;

      for (let index = 0; index < $(".nav-link").length; index++) {
        const element = $(".nav-link")[index];
        if (element.href.includes(value))
        {
            element.classList.add("active");
            element.setAttribute("aria-current", "page");
            console.log("current page: "+value);
        }
      }
}

SetActivePage();
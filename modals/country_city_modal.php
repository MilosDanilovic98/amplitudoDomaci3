<!-- Modal -->
<div class="modal fade" id="countryCityModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="countryModal">Dodavanje lokacije</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body align-middle">

      <form action="./add_location.php" method="POST">
        <input type="text" id="user_id" name="user_id" hidden />
          <div class="row">
              <div class="col-3 offset-2">
                <h5>Država:</h5>
            </div>
              <div class="col-6 mb-2">
              <select class="form-select" aria-label="Default select example" id="country_select"  name="country" onchange="fetchCities()">
                </select>
            </div>
        </div>
                <hr>
            <div class="row">
            <div class="col-3 offset-2">
                <h5>Grad:</h5>
            </div>
              <div class="col-6">
              <select class="form-select" aria-label="Default select example" id="city_select" name="city">
</select>
                </div>

            </div>
            <hr>
          <div class="row mb-2">
              <div class="col-4 offset-4">
                  <button class="btn btn-success w-100" id="submit_btn" disabled>Dodaj lokaciju</button>
              </div>
          </div>
      </form>

      </div>
    </div>
  </div>
</div>

<script>

  //Gets all the cities for the selected countrie
  async function fetchCities(){

    //get the dom elements
    let selectedCountry = document.getElementById("country_select").options.selectedIndex;
    let citiesMenu = document.getElementById("city_select");
    let submitBtn = document.getElementById("submit_btn");

//prepare the response
    let response = await fetch("http://localhost/amplitudoDomaci3/api/cities.php");
    let responseJSON = await response.json();

    let cities = responseJSON.data.filter(city => city.country_id === selectedCountry);

    let citiesTxt = "";

    //check if city matches the countrie
    cities.forEach(city => {
      citiesTxt += `<option id="city_${city.id}" value="${city.name}">${city.name}</option>`;

    })

    citiesMenu.innerHTML = citiesTxt;

    //Checks if the Countrie is Selected and enables the submit button based on that
    if(selectedCountry != 0) submitBtn.disabled = false;
    else submitBtn.disabled = true;

  }

</script>
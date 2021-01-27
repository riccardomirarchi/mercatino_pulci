<div class="dis-none panel-search w-full p-t-10 p-b-15">
  <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">

    <div class="filter-col1 p-r-15 p-b-27">
      <div class="mtext-102 cl2 p-b-15">Regione</div>
      <div style="width:100%" class="size-204 respon6-next">
        <div class="rs1-select2 bor8 bg0">
          <select class="js-select2" name="filter_region" id="filter_region" onchange="changeZoneFilter(this, true)">
            <option disabled selected value="default">Scegli...</option>
          </select>
          <div class="dropDownSelect2"></div>
        </div>
      </div>
    </div>

    <div class="filter-col2"></div>

    <div class="filter-col3 p-r-15 p-b-27">
      <div class="mtext-102 cl2 p-b-15">Provincia</div>
      <div style="width:100%" class="size-204 respon6-next">
        <div class="rs1-select2 bor8 bg0">
          <select class="js-select2" name="filter_province" id="filter_province" onchange="changeZoneFilter(this, false)">
            <option disabled selected value="default">Scegli...</option>
          </select>
          <div class="dropDownSelect2"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<ul class="clearfix">
  <li class="col-5 last">
    <p class="left">
    	Estimated Total<br />
    	<span class="price p-10 block"><?= format_currency($estimated_total) ?></span>
    </p>
    <p class="description right border-1-r">
    	Cart total: <strong><?= format_currency($cart_total) ?></strong><br/>
      Discount: <strong><?= format_currency($discount) ?></strong><br/>
      Tax: <strong><?= format_currency($estimated_tax) ?></strong><br/>
    </p>
  </li>
</ul>
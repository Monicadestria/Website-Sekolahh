@for ($i = 0; $i < $data->line->amount; $i++)
 <div class="col-12 p-0 d-flex justify-content-{{ $data->line->position }} section-partials px-{{ $data->size }}"
  data-margin-top="{{ $data->margin_top }}" data-margin-bottom="{{ $data->margin_bottom }}">
  <div
   class="col-sendiri-section garis-section border-top p-0 
  @if ($data->line->round) border-radius-section-line @endif"
   data-width="{{ $data->line->length }}" data-color="{{ $data->line->color }}"
   data-border-width="{{ $data->line->bold }}">
  </div>
 </div>
@endfor

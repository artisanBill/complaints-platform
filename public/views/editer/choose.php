<div class="modal-header">
    <button class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
    <h4 class="modal-title">{{ trans('anomaly.field_type.wysiwyg::message.choose_folder') }}</h4>
</div>

<div class="modal-body">
    {% if not folders.isEmpty() %}
        <ul class="nav nav-pills nav-stacked">
            {% for folder in folders %}
                <li class="nav-item">
                    <a href="{{ url_to('streams/wysiwyg-field_type/upload/' ~ folder.id) }}?{{ input_get()|url_encode }}"
                       class="nav-link ajax">
                        <strong>{{ folder.name }}</strong>
                        <br>
                        <small>{{ folder.description }}</small>
                    </a>
                </li>
            {% endfor %}
        </ul>
    {% else %}
        {{ trans('streams::message.no_results') }}
    {% endif %}
</div>
<div class="modal-header">

    <button class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>

    <h4 class="title">
        {{ folder.name }}

        {% if folder.description %}
            <br>
            <small class="text-muted">{{ folder.description }}</small>
        {% endif %}
    </h4>

    <div>
        <span class="label label-info">Max: {{ max_upload_size() }}MB</span>

        {% if folder.allowed_types.value %}
            {{ folder.allowed_types.labels|raw }}
        {% endif %}
    </div>

</div>

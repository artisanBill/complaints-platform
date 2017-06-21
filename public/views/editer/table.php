{% if not actions.empty() %}
    {{ asset_add("scripts.js", "streams::js/table/actions.js") }}
{% endif %}

{% if table.options.sortable %}
    {{ asset_add("scripts.js", "streams::js/table/sortable.js") }}
{% endif %}

<div class="{{ table.options.container_class }}">

    {% if not table.rows.empty() %}
        {% block panel %}
            <div class="{{ table.options.panel_class }} panel-table">

                <table
                        class="{{ table.options.class ?: 'table' }}"
                        {{ table.options.sortable ? 'data-sortable' }}
                        {{ html_attributes(table.options.attributes) }}>

                    {% block body %}
                        {{ view("streams::table/partials/body", {'table': table}) }}
                    {% endblock %}

                </table>

            </div>
        {% endblock %}
    {% else %}

        {% block no_results %}
            <div class="{{ table.options.panel_class }}">
                <div class="{{ table.options.panel_body_class }}">
                    {{ trans(table.options.get('no_results_message', 'streams::message.no_results')) }}
                </div>
            </div>
        {% endblock %}

    {% endif %}

</div>

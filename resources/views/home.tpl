{extends file='layout/layout.tpl'}

{block name=js}
    <!--suppress HtmlUnknownTarget -->
    <script type="text/javascript" src="/assets/pages/home.js"></script>
{/block}

{block name=body}
    <div id="tasks">
        <task-filter v-model="filter"></task-filter>
        <ul class="list-group">
            <task-item
                    v-for="item in tasks"
                    :task="item"
                    :key="item.id"
            ></task-item>
        </ul>
        <create-task-form
            v-on:task-created="onTaskCreated"
        ></create-task-form>
    </div>
{/block}
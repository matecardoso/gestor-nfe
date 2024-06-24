<template>
    <div>
        <h6 v-if="title" class="mt-2 text-bold">{{title}}</h6>
        <ul class="nav nav-tabs" :class="ul_class" id="custom-content-above-tab" role="tablist">
            <li class="nav-item" v-for="(content, key) in tabs" v-show="content['show']" :key="key">               
                <a 
                    :class="content['active'] ? 'nav-link active' : 'nav-link'" 
                    :id="key" 
                    data-toggle="pill" 
                    :href="'#content-'+key" 
                    role="tab" 
                    aria-controls="custom-content-above-home" 
                    :aria-selected="content['active'] ? true : false"
                >
                    <i v-if="content['tab_icon']" :class="content['tab_icon']"></i> 
                    {{content['label']}}
                </a>
            </li>
        </ul>
        <div v-if="fix_content" class="tab-custom-content">
            <p class="lead mb-0">{{fix_content}}</p>
        </div>
        <div class="tab-content" id="custom-content-above-tabContent">
            <div :class="content['active'] ? 'tab-pane fade active show' : 'tab-pane fade'" v-for="(content, key) in tabs" :id="'content-'+key" :key="key" role="tabpanel" :aria-labelledby="key">
                <component v-if="!show && content['show']" :is="'form-'+key" :errors="errors" :fields="fields[key]"></component>
                <span v-if="show">
                    <component v-show="content['show']" :is="'form-'+key" :errors="errors" :fields="fields[key]"></component>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'fields', 'errors', 'tabs', 'fix_content', 'ul_class', 'tab_icon', 'show'],
    }
</script>
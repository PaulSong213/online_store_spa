/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

const featuredProductLoader = {
        template:
            `
            <div class="loader my-5">
                <div class="w-full grid grid-cols-1 sm:grid-cols-10 lg:grid-cols-3
                     gap-5 sm:gap-2" style="height: 30vh">
                    <div class="text-loader-container p-5 lg:p-10 
                        md:col-span-3 lg:col-span-1 hidden md:block lg:col-span-1">
                        <div class="text-loader"></div>
                        <div class="text-loader w-4/5"></div>
                        <div class="text-loader w-3/5"></div>
                        <div class="text-loader w-3/5"></div>
                        <div class="text-loader w-4/5"></div>
                        <div class="text-loader"></div>
                    </div>
                    <div class="image-loader bg-gradient-to-r opacity-70
                        from-gray-500 via-gray-400 to-gray-300 rounded-md 
                        shadow-xl animate-pulse sm:col-span-6 
                        md:col-span-5 lg:col-span-1 w-10/12 sm:w-full mx-auto">
                    </div>
                    <div class="text-loader-container p-10 lg:p-20 sm:col-span-4
                         md:col-span-2 lg:col-span-1
                        row-start-2 row-start-auto hidden sm:block">
                        <div class="text-loader"></div>
                        <div class="text-loader w-4/5"></div>
                        <div class="text-loader w-3/5"></div>
                        <div class="text-loader"></div>
                    </div>
                </div>
            </div>
            `    
    }

const circleLoader = {
       template:
            `
            <div class="h-24 w-24 border-8 border-gray-200 
            rounded-full circle-loader mx-auto"></div>
            `
    }
    
const reachedEndMessage = {
       props: ['message'],
       template: 
            `
           <h1 class="text-center text-2xl">
                {{message}}
            </h1>     
            `
    }
 
const filterTag = {
        props: ['tagName','tagId'],
        template: `
            <h5 class="discover-tag  select-false" :id="tagId">{{tagName}}</h5>
        `,
    }
    
    

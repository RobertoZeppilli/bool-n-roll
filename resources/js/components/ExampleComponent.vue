<template>
    <div class="container-fluid p-0 m-0">
        <div class="jumbotron bg-jumbotron">
            <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6">
                    <h1 class="headline">Playing the mood</h1>
                   
                    <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-6 col-md-6 col-lg-6">
                    <img class="img-fluid" src="images/jumboimg.png" alt="Jumbtron">
                </div>
            </div>
        </div>

        <!-- <main>
            Main
        </main>

        <footer>
            Footer
        </footer> -->
    </div>
</template>

<script>
    export default {
        mounted() {
            const label = document.querySelector('.dropdown__filter-selected')
const options = Array.from(document.querySelectorAll('.dropdown__select-option'))

options.forEach((option) => {
	option.addEventListener('click', () => {
		label.textContent = option.textContent
	})
})

// Close dropdown onclick outside
document.addEventListener('click', (e) => {
	const toggle = document.querySelector('.dropdown__switch')
	const element = e.target

	if (element == toggle) return;

	const isDropdownChild = element.closest('.dropdown__filter')		
	
	if (!isDropdownChild) {
		toggle.checked = false
	}
})
        }
    }
</script>

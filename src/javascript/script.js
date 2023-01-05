const sliders = document.querySelectorAll(".carouselbox")

let scrollPerClick
let imagePadding = 20

let scrollAmount = [0,0]


function sliderLeft(index) {
    scrollPerClick = document.querySelector("img").clientWidth + imagePadding;
    sliders[index].scrollTo({top:0, left: (scrollAmount[index] -= scrollPerClick), behavior: "smooth"})
    if (scrollAmount[index] < 0) {scrollAmount[index] = 0}
}

function sliderRight(index) {
    scrollPerClick = document.querySelector("img").clientWidth + imagePadding;
    if (scrollAmount[index] <= sliders[index].scrollWidth - sliders[index].clientWidth){
        sliders[index].scrollTo({top: 0, left: (scrollAmount[index] += scrollPerClick), behavior: "smooth"})
    }
}

function openOpt(evt, id) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(id).style.display = "flex";
    evt.currentTarget.className += " active";
}

function switchEditAbout(id1, id2) {
  let opt1 = document.getElementById(id1)
  let opt2 = document.getElementById(id2)
  opt1.style.display = "none"
  opt2.style.display = "flex"
}

function toogleCartList() {
  let x = document.getElementById('cart_list')
  if (x.style.display === "flex")
    x.style.display = "none"
  else x.style.display = "flex"
}

const searchDish = document.querySelector('#searchdish')

if (searchDish) {
  searchDish.addEventListener('input', async function() {
    const response = await fetch('api/api_dishes.php?search=' + this.value)
    const dishes = await response.json()

    const section = document.querySelector('.dishes_box')
    section.innerHTML = ''

    for (const dish of dishes) {
      const div = document.createElement('div');
      div.classList.add('carouselbox_item');

      const content = `<a href="dish.php?id=${dish['name']}">
                              <h3>${dish['name']}</h3>
                              <img src="images/dishes/${dish['photo']}.jpg">
                          </a>`
      div.innerHTML = content;
      section.appendChild(div)
    }
  })
}

const searchRestaurant = document.querySelector('#searchrestaurant')

if (searchRestaurant) {
  searchRestaurant.addEventListener('input', async function() {
    const response = await fetch('api/api_restaurants.php?search=' + this.value)
    const restaurants = await response.json()

    const section = document.querySelector('.restaurants_box')
    section.innerHTML = ''
  

    for (const restaurant of restaurants) {
      const div = document.createElement('div');
      div.classList.add('carouselbox_item');

      const content = `<a href="restaurant.php?id=${restaurant['id']}">
                              <h3>${restaurant['name']}</h3>
                              <img src="images/restaurants/${restaurant['id']}.jpg">
                          </a>`
      div.innerHTML = content;
      // const carrousel_box_item = document.createElement('div')
      // const img = document.createElement('img')
      // img.src = 'images/restaurants/'+ restaurant['id'] +'.jpg'
      // const name = document.createElement('h3')
      // name.innerHTML = restaurant['name']
      // carrousel_box_item.appendChild(name)
      // carrousel_box_item.appendChild(img)
      // carrousel_box_item.classList.add('carouselbox_item')
      section.appendChild(div)
    }
  })
}

function toggleNav() {
  let x = document.getElementById("navbar")
  if (x.style.width === "0em")
    x.style.width = "6em"
  else x.style.width = "0em"
}

const fav_icon_restaurant = document.querySelector(' .restaurant_info_page header .fav_icon')

const fav_icon_selected_restaurant = document.querySelector(' .restaurant_info_page header .fav_icon_selected')

if(fav_icon_restaurant){
  fav_icon_restaurant.addEventListener('click', function() {
    fav_icon_restaurant.hidden=true
    fav_icon_selected_restaurant.hidden = false
    fetch("../api/api_favourites_restaurants.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: "id=" + fav_icon_restaurant.id + "&action=add"
    })
  })
}

if(fav_icon_selected_restaurant){
  fav_icon_selected_restaurant.addEventListener('click', function() {
    fav_icon_restaurant.hidden=false
    fav_icon_selected_restaurant.hidden = true
    fetch("../api/api_favourites_restaurants.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: "id=" + fav_icon_restaurant.id + "&action=remove"
    })
  })
}

const fav_icon_dish = document.querySelector(' .dish_info_page header .fav_icon')

const fav_icon_selected_dish = document.querySelector(' .dish_info_page header .fav_icon_selected')

if(fav_icon_dish){
  fav_icon_dish.addEventListener('click', function() {
    fav_icon_dish.hidden=true
    fav_icon_selected_dish.hidden = false
    fetch("../api/api_favourites_dishes.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: "dish=" + fav_icon_dish.id + "&action=add"
    })
  })
}

if(fav_icon_selected_dish){
  fav_icon_selected_dish.addEventListener('click', function() {
    fav_icon_dish.hidden=false
    fav_icon_selected_dish.hidden = true
    fetch("../api/api_favourites_dishes.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: "dish=" + fav_icon_dish.id + "&action=remove"
    })
  })
}

order = document.querySelector('.cartListContent')

if(order){
  orderId = order.id
}

function attachBuyEvents() {
  for (const button of document.querySelectorAll('#add_to_cart_button'))
    button.addEventListener('click', function(e) {
      const article = this.parentElement
      const restaurant = document.querySelector('.restaurant_info_page h2').textContent

      const id = article.getAttribute('data-id')

      const username = document.querySelector('#usernamebox').textContent

      const name = id
      const price = article.querySelector('.price').textContent

      text = article.querySelector('.text-order')

      const restaurantId = document.querySelector(' .restaurant_info_page header .fav_icon').id

      let rows = document.querySelectorAll('.cartListContent table tr.product')
      for (const row of rows) {
        let dish = row.querySelector('td:nth-child(1)').textContent
        let restaurant_name = row.querySelector('td:nth-child(2)').textContent
        if(dish==name && restaurant_name == restaurant){
          updateRow(row)
          fetch("../api/api_add_dish_order.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
            },
            body: "customer="+username+"&dish="+name+"&restaurant="+restaurantId+"&action=update"
          })
          updateTotal()
          return
        }
      }
      if(orderId==0){
        orderId == -1
        fetch("../api/api_new_order.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
          },
          body: "customer="+username+"&action=add"        
        })
      }
      addRow(name, price,restaurant,username,restaurantId)
      fetch("../api/api_add_dish_order.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: "customer="+username+"&dish="+name+"&restaurant="+restaurantId+"&text="+text.value+"&action=add"        
      })
      text.value = ""
      
      updateTotal()
    })
}

function addRow(name, price,restaurant,username,restaurantId) {
  const table = document.querySelector('.cartListContent table')
  const row = document.createElement('tr')
  row.setAttribute('data-id', name)
  row.setAttribute('restaurant', restaurant)
  row.classList.add("product")

  const nameCell = document.createElement('td')
  nameCell.textContent = name

  const priceCell = document.createElement('td')
  priceCell.classList.add("price")
  priceCell.textContent = price

  const quantityCell = document.createElement('td')
  quantityCell.textContent = 1

  const restaurantCell = document.createElement('td')
  restaurantCell.textContent = restaurant

  const totalCell = document.createElement('td')
  totalCell.classList.add("price")
  totalCell.textContent = price 

  const deleteCell = document.createElement('td')
  deleteCell.classList.add('delete')
  deleteCell.innerHTML = '<a href="">X</a>'

  deleteCell.querySelector('a').addEventListener('click', function(e) {
    e.preventDefault()
    fetch("../api/api_add_dish_order.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: "customer="+username+"&dish="+name+"&restaurant="+restaurantId+"&action=remove"
    })
    e.currentTarget.parentElement.parentElement.remove()
    updateTotal()
})

  row.appendChild(nameCell)
  row.appendChild(restaurantCell)
  row.appendChild(quantityCell)
  row.appendChild(priceCell)
  row.appendChild(totalCell)
  row.appendChild(deleteCell)

  table.querySelector('tbody').appendChild(row)
}

function updateRow(row) {
  const quantityCell = row.querySelector('td:nth-child(3)')
  const priceCell = row.querySelector('td:nth-child(4)')
  const totalCell = row.querySelector('td:nth-child(5)')
  
  quantityCell.textContent = parseInt(quantityCell.textContent, 10) + 1
  totalCell.textContent = parseFloat(priceCell.textContent, 10) + parseFloat(totalCell.textContent, 10)
}

function updateTotal() {
  let total_price = 0
  let rows = document.querySelectorAll('.cartListContent table tr.product')
  for (const row of rows) {
    let total = row.querySelector('td:nth-child(5)').textContent
    total_price+= parseFloat(total)
  } 

  document.querySelector('#numb_cart_items').textContent = rows.length
  document.querySelector('tfoot .price').textContent = total_price
  
}

function checkForDeletes(){
  let deletes = document.querySelectorAll('.delete a')

  const user = document.querySelector('#usernamebox')

  if(user){
    username = user.textContent
  }

  for (x of deletes){
    dish = x.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.textContent
    restaurantId = x.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.id
    x.addEventListener('click', function(e) {
      e.preventDefault()
      fetch("../api/api_add_dish_order.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: "customer="+username+"&dish="+dish+"&restaurant="+restaurantId+"&action=remove"
      })
      e.currentTarget.parentElement.parentElement.remove()
      updateTotal()
  })
}
}


checkForDeletes()
attachBuyEvents()

addOrder = document.querySelector('#add_order')

  if(addOrder){
    addOrder.addEventListener('click',function(e){
    fetch("../api/api_make_order.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: ""
    })
    content = document.querySelector('.cartListContent table tbody')
    content.innerHTML=""
    document.querySelector('tfoot .price').textContent = 0
    document.querySelector('#numb_cart_items').textContent = 0
  })
  }

// Get the element with id="defaultOpen" and click on it
open = document.getElementById("defaultOpen")

if(open){
  open.click();
}

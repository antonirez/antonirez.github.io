import { useEffect, useState } from 'react'

export default function Home() {
  const [cart, setCart] = useState([])

  useEffect(() => {
    fetch('http://localhost:8080/cart')
      .then(res => res.json())
      .then(data => setCart(data))
  }, [])

  return (
    <div>
      <h1>Cart Items</h1>
      <ul>
        {cart.map((item, i) => (
          <li key={i}>{item.product} - qty {item.qty}</li>
        ))}
      </ul>
    </div>
  )
}

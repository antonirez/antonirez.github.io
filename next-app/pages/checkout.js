export default function Checkout() {
  const doCheckout = async () => {
    const res = await fetch('http://localhost:8080/checkout', { method: 'POST' })
    const data = await res.json()
    alert('Order total: ' + data.order.total)
  }

  return (
    <button onClick={doCheckout}>Checkout</button>
  )
}

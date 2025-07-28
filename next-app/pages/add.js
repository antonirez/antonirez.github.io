import { useState } from 'react'

export default function Add() {
  const [product, setProduct] = useState('')
  const [qty, setQty] = useState(1)

  const submit = async e => {
    e.preventDefault()
    await fetch('http://localhost:8080/cart/add', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ product, qty: parseInt(qty) })
    })
    setProduct('')
    setQty(1)
  }

  return (
    <form onSubmit={submit}>
      <input value={product} onChange={e => setProduct(e.target.value)} placeholder='product'/>
      <input type='number' value={qty} onChange={e => setQty(e.target.value)} />
      <button type='submit'>Add</button>
    </form>
  )
}

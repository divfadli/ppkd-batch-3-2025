import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

function App() {
  const [count, setCount] = useState(0)

  function Heading({isi, subtitle}){
    return (
      <div style={{textAlign:"left"}}>
        <h1>{isi}</h1>
        <p>{subtitle}</p>
      </div>
  );
  }
  return (
    // Fragment (<></>)
    <> 
    <Heading isi="Ini Heading di react" subtitle="React dengan vite"/>
    <Heading isi="React enak" subtitle="React idolaku"/>
    <Heading isi="JavaScript tidak bisa membeli lamborgini" subtitle="Chum is FUM"/>
      {/* <div>
        <a href="https://vite.dev" target="_blank">
          <img src={viteLogo} className="logo" alt="Vite logo" />
        </a>
        <a href="https://react.dev" target="_blank">
          <img src={reactLogo} className="logo react" alt="React logo" />
        </a>
      </div>
      <h1>Vite + React</h1>
      <div className="card">
        <button onClick={() => setCount((count) => count + 1)}>
          count is {count}
        </button>
        <p>
          Edit <code>src/App.jsx</code> and save to test HMR
        </p>
      </div>
      <p className="read-the-docs">
        Click on the Vite and React logos to learn more
      </p> */}
    </>
  )
}

export default App

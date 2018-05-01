import React from 'react'

const About = () => {
  return (
    <div>
      <h1>This is Kris Blog</h1>
      <p>if you wanna connect with me, plz enter below</p> 
      <form onClick={(e)=> { e.preventDefault(); alert("It's not working yet") }}>
        <div className="form-group">
          <label htmlFor="userName">Your Name</label>
          <input type="text" className="form-control" id="userName" placeholder="Enter Your Name" />
        </div>
        <div className="form-group">
          <label htmlFor="content">What U Wanna Talk To Me?</label>
          <textarea type="text" className="form-control" id="content" placeholder="Plz enter your infomations." />
        </div>
        <button type="submit" className="btn btn-secondary">Submit</button>
      </form>
    </div>
  )
}

export default About
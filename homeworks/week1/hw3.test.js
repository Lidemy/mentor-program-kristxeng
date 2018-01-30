import {isPrime} from './hw3'

describe("hw3", () => {
  it("should return correct answer when n = 1", () => {
    expect(isPrime(1)).toBe(false)
  })

  it("should return correct answer when n = 1451", () => {
    expect(isPrime(1451)).toBe(true)
  })

  it("should return correct answer when n = 491", () => {
    expect(isPrime(491)).toBe(true)
  })

  it("should return correct answer when n = 1024", () => {
    expect(isPrime(1024)).toBe(false)
  })

  it("should return correct answer when n = 2", () => {
    expect(isPrime(2)).toBe(true)
  })  

  it("should return correct answer when n = 3", () => {
    expect(isPrime(3)).toBe(true)
  })

  it("should return correct answer when n = 28", () => {
    expect(isPrime(28)).toBe(false)
  })
  
})
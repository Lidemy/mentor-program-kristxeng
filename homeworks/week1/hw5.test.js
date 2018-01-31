import {add} from './hw5'

describe("hw5", () => {
  it("should return correct answer when a=10 and b=10", () => {
    expect(add('10', '10')).toBe('20')
  })

  it("should return correct answer when a=1234 and b=156", () => {
    expect(add('1234', '156')).toBe('1390')
  })

  it("should return correct answer when a=5000 and b=5123", () => {
    expect(add('5000', '5123')).toBe('10123')
  })

  it("should return correct answer when a=8567 and b=278532", () => {
    expect(add('8567', '278532')).toBe('287099')
  })

  it("should return correct answer when a=9865 and b=9999", () => {
    expect(add('9865', '9999')).toBe('19864')
  })

  it("should return correct answer when a=2312383813881381381 and b=129018313819319831", () => {
    expect(add('12312383813881381381', '129018313819319831')).toBe('12441402127700701212')
  })


})
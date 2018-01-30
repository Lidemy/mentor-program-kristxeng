import {capitalize} from './hw2'

describe("hw2", () => {
  it("should return correct answer when str = nick", () => {
    expect(capitalize('nick')).toBe('Nick')
  })
  it("should return correct answer when str = Adam", () => {
    expect(capitalize('Adam')).toBe('Adam')
  })
  it("should return correct answer when str = 123abc", () => {
    expect(capitalize('123abc')).toBe('123abc')
  })
  it("should return correct answer when str = @tom", () => {
    expect(capitalize('@tom')).toBe('@tom')
  })
})